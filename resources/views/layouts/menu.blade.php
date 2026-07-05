@php
    $activeClass = 'font-black text-red-300';
@endphp


<div class="dark:bg-zinc-800 bg-white w-full py-4 border-b dark:text-white text-black">
    <div class="max-w-[800px] m-auto flex justify-between items-center">
        <ul class="flex space-x-10">

            <li class="{{ request()->routeIs('monthly') ? $activeClass : '' }}">
                <a href="{{ route('monthly') }}">Monthly</a>
            </li>

            <li class="{{ request()->routeIs('cashsmash') ? $activeClass : '' }}">
                <a href="{{ route('cashsmash') }}">Cashsmash</a>
            </li>

            <li class="{{ request()->routeIs('savings') ? $activeClass : '' }}">
                <a href="{{ route('savings') }}">Savings</a>
            </li>

            <li class="{{ request()->routeIs('budgets') ? $activeClass : '' }}">
                <a href="{{ route('budgets') }}">Budgets</a>
            </li>
        </ul>


        <div class="flex items-center space-x-4 ">
            <div x-data="{
            theme: localStorage.getItem('theme') || 'light',
            toggle() {
                this.theme = this.theme === 'dark' ? 'light' : 'dark';
                localStorage.setItem('theme', this.theme);
                if (this.theme === 'dark') {
                    document.documentElement.classList.add('dark');
                } else {
                    document.documentElement.classList.remove('dark');
                }
            }
        }">
                <button @click="toggle()" class="text-xl">
                    <i :class="theme === 'dark' ? 'fas fa-sun' : 'fas fa-moon'"></i>
                </button>
            </div>

            <a href="{{ route('profile') }}">
                <i class="fas fa-cog text-xl"></i>
            </a>

        </div>

    </div>
</div>