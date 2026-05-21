<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>School Flow • Sign In</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700&display=swap" rel="stylesheet" />
    
    <style>
        body {
            font-family: 'Outfit', sans-serif;
        }
        
        .glass-card {
            background: rgba(24, 24, 27, 0.75);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(63, 63, 70, 0.6);
        }

        .gradient-bg {
            background: linear-gradient(135deg, #0f172a 0%, #1e2937 100%);
        }
    </style>
</head>
<body class="gradient-bg text-zinc-100 min-h-screen flex items-center justify-center p-6 relative overflow-hidden">
    
    <!-- Subtle Background Elements -->
    <div class="absolute inset-0 bg-[radial-gradient(at_top_right,#4f46e510_0%,transparent_50%)]"></div>
    <div class="absolute bottom-0 left-0 w-96 h-96 bg-indigo-600/10 rounded-full blur-3xl"></div>
    <div class="absolute top-0 right-0 w-96 h-96 bg-violet-600/10 rounded-full blur-3xl"></div>

    <div class="w-full max-w-md relative z-10">
        
        <!-- Brand Header -->
        <div class="flex flex-col items-center text-center mb-10">
            <div class="w-16 h-16 bg-gradient-to-br from-indigo-500 via-violet-500 to-purple-600 rounded-3xl flex items-center justify-center text-4xl shadow-xl shadow-indigo-500/30 mb-5">
                📚
            </div>
            <h1 class="text-4xl font-semibold tracking-tighter">School Flow</h1>
            <p class="text-zinc-400 mt-2 text-lg">Academic Workspace</p>
        </div>

        <!-- Main Card -->
        <div class="glass-card rounded-3xl p-10 shadow-2xl">
            <h2 class="text-2xl font-semibold text-center mb-8">Welcome Back</h2>

            <!-- Error Message -->
            @if ($errors->any())
            <div class="mb-8 p-4 bg-red-500/10 border border-red-500/30 rounded-2xl text-red-400 text-sm flex gap-3">
                <i class="fa-solid fa-circle-exclamation mt-0.5"></i>
                <div>
                    <span class="font-medium">Login failed</span>
                    <ul class="list-disc pl-5 mt-1 text-xs space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
            @endif

            <form method="POST" action="/login" class="space-y-6">
                @csrf

                <!-- Email -->
                <div>
                    <label class="text-xs font-medium tracking-widest text-zinc-400 block mb-2">EMAIL ADDRESS</label>
                    <div class="relative group">
                        <i class="fa-solid fa-envelope absolute left-5 top-1/2 -translate-y-1/2 text-zinc-500 group-focus-within:text-indigo-400 transition-colors"></i>
                        <input 
                            type="email" 
                            id="email"
                            name="email" 
                            value="{{ old('email') }}"
                            placeholder="student@school.edu"
                            required
                            autofocus
                            class="w-full bg-zinc-900 border border-zinc-700 focus:border-indigo-500 rounded-2xl pl-12 pr-5 py-4 outline-none text-sm transition-all duration-200"
                        />
                    </div>
                </div>

                <!-- Password -->
                <div>
                    <label class="text-xs font-medium tracking-widest text-zinc-400 block mb-2">PASSWORD</label>
                    <div class="relative group">
                        <i class="fa-solid fa-lock absolute left-5 top-1/2 -translate-y-1/2 text-zinc-500 group-focus-within:text-indigo-400 transition-colors"></i>
                        <input 
                            type="password" 
                            id="password"
                            name="password" 
                            placeholder="••••••••"
                            required
                            class="w-full bg-zinc-900 border border-zinc-700 focus:border-indigo-500 rounded-2xl pl-12 pr-5 py-4 outline-none text-sm transition-all duration-200"
                        />
                    </div>
                </div>

                <div class="flex items-center justify-between">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="remember" 
                               class="w-4 h-4 accent-indigo-600 bg-zinc-900 border-zinc-600 rounded focus:ring-indigo-500">
                        <span class="text-sm text-zinc-400">Remember me</span>
                    </label>
                    
                    <a href="#" class="text-sm text-indigo-400 hover:text-indigo-300 transition-colors font-medium">
                        Forgot password?
                    </a>
                </div>

                <!-- Submit Button -->
                <button 
                    type="submit"
                    class="w-full bg-white text-zinc-900 hover:bg-zinc-100 active:scale-[0.985] font-semibold py-4 rounded-2xl text-base tracking-wide transition-all duration-200 shadow-lg shadow-indigo-500/10 mt-4">
                    SIGN IN
                </button>
            </form>
        </div>

        <!-- Footer -->
        <div class="text-center mt-8">
            <p class="text-xs text-zinc-500">
                Protected by <span class="text-emerald-400">School Flow</span> • Secure Login
            </p>
        </div>
    </div>
</body>
</html>