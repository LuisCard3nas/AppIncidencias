<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>En construcción</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .pulse-emoji {
            animation: pulse 2s infinite;
        }
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.2); }
            100% { transform: scale(1); }
        }
    </style>
</head>
<body class="bg-[#fef6e4] min-h-screen flex items-center justify-center">
    <div class="text-center p-8 max-w-md">
        <div class="text-8xl mb-6 pulse-emoji">🥵</div>
        <h1 class="text-3xl font-bold mb-2">¡Igual se sigue construyendo!</h1>
        <p class="text-[#0a0a0a] text-lg">Con esta cara de esfuerzo y dedicación</p>
        
        <div class="mt-10">
            <a href="/" class="inline-block px-6 py-2 bg-[#ff6b6b] hover:bg-[#ff5252] text-white rounded-full text-sm font-medium transition-all">
                Ver progreso
            </a>
        </div>
    </div>
</body>
</html>