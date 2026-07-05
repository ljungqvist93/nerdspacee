<div class="min-h-screen flex flex-col justify-center items-center bg-gray-100 dark:bg-zinc-900 px-4">

    <div class="w-full max-w-md bg-white dark:bg-zinc-800 shadow-md rounded-lg p-8">
        <h1 class="text-3xl font-bold mb-6 text-center text-gray-900 dark:text-white">
            Log in
        </h1>

        <!-- Session Status -->
        @if (session('status'))
            <div class="mb-4 text-sm text-green-600 dark:text-green-400">
                {{ session('status') }}
            </div>
        @endif

        <!-- Validation Errors -->
        @if ($errors->any())
            <div class="mb-4 bg-red-100 dark:bg-red-900 text-red-700 dark:text-red-300 p-3 rounded">
                <ul class="list-disc pl-5 text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}" class="space-y-6">
            @csrf

            <!-- Email -->
            <div>
                <label for="email" class="block mb-1 font-medium text-gray-700 dark:text-gray-300">
                    Email
                </label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                    class="w-full border-gray-300 dark:border-zinc-700 dark:bg-zinc-700 dark:text-white rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block mb-1 font-medium text-gray-700 dark:text-gray-300">
                    Password
                </label>
                <input id="password" type="password" name="password" required
                    class="w-full border-gray-300 dark:border-zinc-700 dark:bg-zinc-700 dark:text-white rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
            </div>

            <!-- Remember Me -->
            <div class="flex items-center">
                <input id="remember_me" type="checkbox" name="remember"
                    class="rounded border-gray-300 dark:border-zinc-600 dark:bg-zinc-700 text-blue-600 focus:ring-blue-500">
                <label for="remember_me" class="ml-2 text-sm text-gray-600 dark:text-gray-300">
                    Remember me
                </label>
            </div>

            <div class="flex justify-between items-center">
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}"
                        class="text-sm text-blue-600 dark:text-blue-400 hover:underline">
                        Forgot your password?
                    </a>
                @endif
            </div>

            <!-- Submit -->
            <button type="submit"
                class="w-full py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-md font-semibold transition">
                Log In
            </button>

        </form>
    </div>
</div>