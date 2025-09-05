<?php

namespace App\Modules\Incidents\Http\Controllers;

use App\Modules\Incidents\Models\Application;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ApplicationController extends Controller
{
    public function index(Request $request): View
    {
        // Verificar que el usuario esté autenticado y tenga permisos
        if (!auth()->check() || (!auth()->user()->isAlcalde() && !auth()->user()->isCiudadano() && !auth()->user()->isAdministrador())) {
            abort(403, 'Solo el Alcalde, Administradores y Ciudadanos pueden acceder a esta sección.');
        }

        // Si es ciudadano, solo mostrar sus propias aplicaciones
        if (auth()->user()->isCiudadano()) {
            $query = Application::where('reference_user_id', auth()->id())
                               ->with(['user', 'responsibleUser']);
        } else {
            // Si es alcalde o administrador, mostrar todas las aplicaciones
            $query = Application::with(['user', 'responsibleUser']);
        }

        // Filtrar por estado si se proporciona
        if ($request->has('state') && $request->state !== '') {
            $query->where('state', $request->state);
        }

        $applications = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('incidents::index', compact('applications'));
    }

    public function create(): View
    {
        return view('incidents::create');
    }

    public function store(Request $request): RedirectResponse
    {
        // Validar los datos del formulario
        $validated = $request->validate([
            'type' => ['required', 'string', 'in:' . implode(',', array_keys(Application::getTypes()))],
            'descripcion' => ['required', 'string', 'min:10', 'max:1000'],
            'ubication' => ['required', 'string', 'min:5', 'max:255'],
        ], [
            'type.required' => 'El tipo de solicitud es obligatorio.',
            'type.in' => 'El tipo de solicitud seleccionado no es válido.',
            'descripcion.required' => 'La descripción es obligatoria.',
            'descripcion.min' => 'La descripción debe tener al menos 10 caracteres.',
            'descripcion.max' => 'La descripción no puede exceder 1000 caracteres.',
            'ubication.required' => 'La ubicación es obligatoria.',
            'ubication.min' => 'La ubicación debe tener al menos 5 caracteres.',
            'ubication.max' => 'La ubicación no puede exceder 255 caracteres.',
        ]);

        // Crear la nueva solicitud
        Application::create([
            'reference_user_id' => auth()->id(),
            'type' => $validated['type'],
            'descripcion' => $validated['descripcion'],
            'ubication' => $validated['ubication'],
            'state' => Application::STATE_PENDIENTE, // Estado inicial
        ]);

        return Redirect::route('applications.index')
            ->with('success', '✅ Su solicitud ha sido creada exitosamente. El estado inicial es "Pendiente" y será revisada por las autoridades competentes.');
    }

    public function show(int $id): View
    {
        $application = Application::with(['user', 'responsibleUser'])->findOrFail($id);
        return view('incidents::show', compact('application'));
    }

    public function edit(int $id): View
    {
        // Verificar que el usuario sea alcalde o administrador
        if (!auth()->user()->isAlcalde() && !auth()->user()->isAdministrador()) {
            abort(403, 'Solo el Alcalde y los Administradores pueden editar solicitudes.');
        }

        $application = Application::with(['user', 'responsibleUser'])->findOrFail($id);
        
        return view('incidents::edit', compact('application'));
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        // Verificar que el usuario sea alcalde o administrador
        if (!auth()->user()->isAlcalde() && !auth()->user()->isAdministrador()) {
            abort(403, 'Solo el Alcalde y los Administradores pueden editar solicitudes.');
        }

        $application = Application::findOrFail($id);

        // Validar los datos del formulario
        $validated = $request->validate([
            'state' => ['required', 'string', 'in:' . implode(',', array_keys(Application::getStates()))],
            'responsible_user_id' => ['nullable', 'exists:users,id'],
        ], [
            'state.required' => 'El estado es obligatorio.',
            'state.in' => 'El estado seleccionado no es válido.',
            'responsible_user_id.exists' => 'El responsable seleccionado no existe.',
        ]);

        // Si se asigna un responsable, verificar que sea funcionario o administrador
        if ($validated['responsible_user_id']) {
            $responsibleUser = \App\Models\User::with('role')->find($validated['responsible_user_id']);
            if (!$responsibleUser || (!$responsibleUser->isFuncionario() && !$responsibleUser->isAdministrador())) {
                return back()->withErrors(['responsible_user_id' => 'Solo se pueden asignar funcionarios o administradores como responsables.']);
            }
        }

        // Actualizar la solicitud
        $application->update([
            'state' => $validated['state'],
            'responsible_user_id' => $validated['responsible_user_id'],
        ]);

        $message = '✅ La solicitud ha sido actualizada exitosamente.';
        if ($validated['responsible_user_id']) {
            $responsibleName = \App\Models\User::find($validated['responsible_user_id'])->name;
            $message .= " Responsable asignado: {$responsibleName}.";
        }

        return Redirect::route('applications.index')
            ->with('success', $message);
    }

    public function destroy(int $id): RedirectResponse
    {
        // Delete the application
        return Redirect::route('applications.index');
    }
}