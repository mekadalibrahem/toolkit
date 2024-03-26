<x-layouts.app >
    <x-slot:title >
       Register
    </x-slot:title>


    <section class="">
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
            <a href="#" class="flex items-center mb-6 text-2xl font-semibold text-gray-900 dark:text-white">
                <img class="w-15 h-12 mr-2" src="./images/toolkit_logo_dark.png" alt="logo">
               Tool kit
            </a>
            <div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                        Create new account
                    </h1>
                    <form class="space-y-4 md:space-y-6" action="{{Route('register')}}" method="POST" >
                        @csrf
                        <div>
                            <x-form.label for="name" value="name" />
                            <x-form.input type="text" name="name" id="name" required=""/>
                            <x-form.input-error  :message="$errors->get('name')" />
                        </div>
                        <div>
                            <x-form.label for="email" value="email" />
                            <x-form.input type="email" name="email" id="email" required=""/>
                            <x-form.input-error  :message="$errors->get('email')" />
                        </div>
                        <div>
                            <x-form.label for="password" value="password" />
                            <x-form.input type="password" name="password" id="password" required=""/>
                            <x-form.input-error  :message="$errors->get('password')" />
                        </div>
                        <div>
                            <x-form.label for="confirm_password" value="confirm password" />
                            <x-form.input type="password" name="confirm_password" id="confirm_password" required=""/>
                            <x-form.input-error  :message="$errors->get('confirm_password')" />
                        </div>

                        <x-button.primary type="submit">Sign Up</x-button.primary>
                        <p class="text-sm font-light text-gray-500 dark:text-gray-400">
                            Already registered? <a href="{{ Route('login') }}" class="font-medium text-primary-600 hover:underline dark:text-primary-500">Login</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
      </section>

</x-layouts.app>
