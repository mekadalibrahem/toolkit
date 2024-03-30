    <!--- update profile section  --->
    <section class="bg-white container mx-auto   mt-8 rounded-lg  dark:bg-gray-900">
        <div class="max-w-2xl px-4 py-8 mx-auto lg:py-16">
            <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Update account</h2>
            @if ($info_status != '')
                <x-alert.alert type='success' :message="$info_status" />
            @endif

            <form wire:submit="edit">
                @csrf
                <div class="grid gap-4 mb-4 sm:grid-cols-2 sm:gap-6 sm:mb-5">
                    <div class="sm:col-span-2">
                        <x-form.label for="name" value='name' />
                        <x-form.input type='text' wire:model='name' id="name" name='name' required />
                        @error('name') <x-alert.alert type="danger" :message="$message" />@enderror
                    </div>
                    <div class="sm:col-span-2">
                        <x-form.label for="email" value='email' />
                        <x-form.input type='text' wire:model='email' id="email" name='email' required />
                        @error('email') <x-alert.alert type="danger" :message="$message" />@enderror
                    </div>
                    <div class=" flex  items-center  space-x-4">
                        <x-button.primary type="submit" class="w-auto">
                            Update
                        </x-button.primary>

                    </div>
                </div>

            </form>
        </div>
    </section>
