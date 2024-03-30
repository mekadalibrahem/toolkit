<section class="bg-white container  mt-8 rounded-lg mx-auto  dark:bg-gray-900">
    <div class="max-w-2xl px-4 py-8 mx-auto lg:py-16">
        <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Devices </h2>
        <div class="grid gap-4 mb-4 sm:grid-cols-2 sm:gap-6 sm:mb-5">
            <div class="sm:col-span-2">
                @if (session('status') === 'device-update')
                    <x-alert.alert type='info' message="devices updated" />
                @endif
            </div>
            <div class="sm:col-span-2">
                If necessary, you may log out of all of your other browser sessions across all of your devices.
                Some of your recent sessions are listed below; however, this list may not be exhaustive. If you
                feel your account has been compromised, you should also update your password.

            </div>
            <div class="sm:col-span-2">

                @if ($sessions)
                    <div class="my-5 space-y-6">
                        <!-- Other Browser Sessions -->
                        @foreach ($sessions as $session)
                            <livewire:profile.device-item
                                :is_desktop="$session['agent']->isDesktop()"
                                :platform="$session['agent']->platform()"
                                :browser="$session['agent']->browser()"
                                :last_active="$session['last_active']"
                                :ip_address="$session['ip_address']"
                                :is_current_device="$session['is_current_device']"

                            />

                        @endforeach
                    </div>
                @endif



                <div x-data="{ show: false }">

                    <x-button.primary type="button" class="w-auto lg:w-2/5" x-on:click="show = ! show">
                        log out other devices
                    </x-button.primary>
                    <x-model title="confirm password" show="show" x-on:click="show = ! show">
                        <div class="p-4 md:p-5">
                            <form wire:submit="logout_others" method="POST">
                                @csrf
                                <div>
                                    @if ($logout_status != [])
                                        <x-alert.alert :type="$logout_status['type']" :message="$logout_status['message']" />
                                    @endif
                                </div>
                                <div class="sm:col-span-2 mb-4">
                                    <x-form.label for="password" value='password' />
                                    <x-form.input type='password' wire:model="password" id="password" name='password'
                                        required fouce />
                                    @error('password')
                                        <X-alert.alert type="danger" :message="$message" />
                                    @enderror


                                </div>
                                <x-button.danger type="submit" class="mt-4">

                                    logout
                                </x-button.danger>
                            </form>


                        </div>
                    </x-model>
                </div>
            </div>
        </div>
    </div>
</section>
