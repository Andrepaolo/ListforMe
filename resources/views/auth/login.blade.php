<x-guest-layout>
    {{-- A classe `min-h-screen` e `flex items-center justify-center` geralmente já estão no guest-layout. --}}
    {{-- Vamos adicionar a imagem de fundo e um overlay para que o conteúdo do modal se destaque. --}}
    <div class="relative min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0"
         style="background-image: url('{{ asset('images/super.jpg') }}'); background-size: cover; background-position: center; background-repeat: no-repeat; background-attachment: fixed;">

        {{-- Overlay para escurecer a imagem de fundo e melhorar a legibilidade do formulário --}}
        <div class="absolute inset-0 bg-black opacity-40"></div>

        {{-- O conteúdo do x-authentication-card vai ficar acima do overlay --}}
        <div class="relative z-10">
            <x-authentication-card>
                <x-slot name="logo">
                    {{-- O componente authentication-card-logo já foi modificado acima --}}
                    <x-authentication-card-logo />
                </x-slot>

                <x-validation-errors class="mb-4 text-red-700" /> {{-- Ajustado el color del texto de error --}}

                @session('status')
                    <div class="mb-4 font-medium text-sm text-green-600">
                        {{ $value }}
                    </div>
                @endsession

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="text-[#556b2f]"> {{-- Aplica el color del texto a los labels --}}
                        <x-label for="email" value="{{ __('Email') }}" class="font-semibold" /> {{-- Añadido font-semibold --}}
                        <x-input id="email" class="block mt-1 w-full border-[#a7b48c] focus:border-[#8f9779] focus:ring focus:ring-[#8f9779] focus:ring-opacity-50 rounded-md shadow-sm text-[#556b2f]" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                    </div>

                    <div class="mt-4 text-[#556b2f]"> {{-- Aplica el color del texto a los labels --}}
                        <x-label for="password" value="{{ __('Senha') }}" class="font-semibold" /> {{-- Cambiado 'Password' a 'Senha' y añadido font-semibold --}}
                        <x-input id="password" class="block mt-1 w-full border-[#a7b48c] focus:border-[#8f9779] focus:ring focus:ring-[#8f9779] focus:ring-opacity-50 rounded-md shadow-sm text-[#556b2f]" type="password" name="password" required autocomplete="current-password" />
                    </div>

                    <div class="block mt-4">
                        <label for="remember_me" class="flex items-center text-[#7a7a58]"> {{-- Ajustado el color del texto --}}
                            <x-checkbox id="remember_me" name="remember" class="form-checkbox text-[#556b2f] border-[#a7b48c] rounded focus:ring-[#8f9779]" /> {{-- Estilo del checkbox --}}
                            <span class="ms-2 text-sm">{{ __('Lembre-me') }}</span> {{-- Cambiado 'Remember me' a 'Lembre-me' --}}
                        </label>
                    </div>

                    <div class="flex items-center justify-between mt-6"> {{-- Cambiado justify-end a justify-between para mover el link --}}
                        @if (Route::has('password.request'))
                            <a class="underline text-sm text-[#7a7a58] hover:text-[#556b2f] rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#8f9779]" href="{{ route('password.request') }}">
                                {{ __('Esqueceu sua senha?') }}
                            </a>
                        @endif

                        <x-button class="ms-4 bg-[#556b2f] hover:bg-[#425823] text-white font-semibold py-2 px-6 rounded-lg transition-colors duration-300">
                            {{ __('Entrar') }}
                        </x-button>
                    </div>

                    {{-- Añadir un enlace para registrarse, como en la página de bienvenida --}}
                    <div class="text-center mt-6 text-[#7a7a58]">
                        <p>Ainda não tem uma conta? <a href="{{ route('register') }}" class="underline text-[#556b2f] hover:text-[#8f9779]">Cadastre-se</a></p>
                    </div>
                </form>
            </x-authentication-card>
        </div>
    </div>
</x-guest-layout>