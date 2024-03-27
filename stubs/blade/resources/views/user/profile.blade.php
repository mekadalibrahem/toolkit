<x-layouts.app >
    <x-slot:title >
        Profile
    </x-slot:title>
    <x-layouts.nav />
    <main class=" h-screen overflow-auto dark:bg-gray-700" >


         <!--- update profile section  --->
        <section class="bg-white container mx-auto   mt-8 rounded-lg  dark:bg-gray-900">
            <div class="max-w-2xl px-4 py-8 mx-auto lg:py-16">
                <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Update account</h2>
                @if (session('status') === 'profile-updated')
                    <x-alert.alert type='success' message="profile updated" />
                @endif

                <form action="{{ Route('profile.update') }}" method="POST" >
                    @csrf
                    <div class="grid gap-4 mb-4 sm:grid-cols-2 sm:gap-6 sm:mb-5">
                        <div class="sm:col-span-2">
                            <x-form.label for="name" value='name' />
                            <x-form.input type='text' id="name" name='name' :value="$user->name"  required/>
                            <x-form.input-error  :message="$errors->get('name')" />
                        </div>
                        <div class="sm:col-span-2">
                            <x-form.label for="email" value='email' />
                            <x-form.input type='text' id="email" name='email' :value="$user->email" required />
                            <x-form.input-error  :message="$errors->get('email')" />
                        </div>
                        <div class=" flex  items-center  space-x-4">
                            <x-button.primary type="submit"  class="w-auto">
                                Update
                            </x-button.primary>

                        </div>
                    </div>

                </form>
            </div>
        </section>


        <!--- update password section  --->
        <section class="bg-white container  mt-8 rounded-lg mx-auto  dark:bg-gray-900">
            <div class="max-w-2xl px-4 py-8 mx-auto lg:py-16">
                <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">change password</h2>
                @if (session('status') === 'password-updated')
                    <x-alert.alert type='success' message="password updated" />
                @endif

                <form action="{{ Route('profile.change-password') }}" method="POST" >
                    @csrf
                    <div class="grid gap-4 mb-4 sm:grid-cols-2 sm:gap-6 sm:mb-5">
                        <div class="sm:col-span-2">
                            <x-form.label for="password" value='password' />
                            <x-form.input type='password' id="password" name='password' value=""  required />
                            <x-form.input-error  :message="$errors->get('password')" />
                        </div>
                        <div class="sm:col-span-2">
                            <x-form.label for="new_password" value='new password' />
                            <x-form.input type='password' id="new_password" name='new_password' value="" />
                            <x-form.input-error  :message="$errors->get('new_password')" />
                        </div>
                        <div class="sm:col-span-2">
                            <x-form.label for="confirm_password" value='confirm password' />
                            <x-form.input type='password' id="confirm_password" name='confirm_password' value="" />
                            <x-form.input-error  :message="$errors->get('password')" />
                        </div>
                        <div class=" flex  items-center  space-x-4">
                            <x-button.primary type="submit"  class="w-auto">
                                Change password
                            </x-button.primary>

                        </div>
                    </div>
                </form>
            </div>
        </section>

        <!--- divices sessions section  --->
        <section class="bg-white container  mt-8 rounded-lg mx-auto  dark:bg-gray-900">
            <div class="max-w-2xl px-4 py-8 mx-auto lg:py-16">
                <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Devices </h2>
                <form action="{{Route('logout_other')}}" method="POST" >
                    <div class="grid gap-4 mb-4 sm:grid-cols-2 sm:gap-6 sm:mb-5">
                        <div class="sm:col-span-2" >
                            @if (session('status') === 'device-update' )
                                <x-alert.alert type='info' message="devices updated" />
                            @endif
                        </div>

                            @csrf
                            <div class="sm:col-span-2">
                                If necessary, you may log out of all of your other browser sessions across all of your devices. Some of your recent sessions are listed below; however, this list may not be exhaustive. If you feel your account has been compromised, you should also update your password.

                            </div>
                            <div class="sm:col-span-2">

                                @if (count($sessions) > 0)
                                <div class="mt-5 space-y-6">
                                    <!-- Other Browser Sessions -->
                                    @foreach ($sessions as $session)
                                        <div class="flex items-center">
                                            <div>
                                                @if ($session->agent->isDesktop())
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 text-gray-500">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 17.25v1.007a3 3 0 01-.879 2.122L7.5 21h9l-.621-.621A3 3 0 0115 18.257V17.25m6-12V15a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 15V5.25m18 0A2.25 2.25 0 0018.75 3H5.25A2.25 2.25 0 003 5.25m18 0V12a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 12V5.25" />
                                                    </svg>
                                                @else
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 text-gray-500">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 1.5H8.25A2.25 2.25 0 006 3.75v16.5a2.25 2.25 0 002.25 2.25h7.5A2.25 2.25 0 0018 20.25V3.75a2.25 2.25 0 00-2.25-2.25H13.5m-3 0V3h3V1.5m-3 0h3m-3 18.75h3" />
                                                    </svg>
                                                @endif
                                            </div>

                                            <div class="ms-3">
                                                <div class="text-sm text-gray-600 dark:text-gray-400">
                                                    {{  $session->agent->platform()?
                                                        $session->agent->platform() : __('Unknown')
                                                    }} -
                                                    {{  $session->agent->browser() ?
                                                        $session->agent->browser() : __('Unknown')
                                                    }}
                                                </div>

                                                <div>
                                                    <div class="text-xs text-gray-500">
                                                        {{ $session->ip_address }},

                                                        @if ($session->is_current_device)
                                                            <span class="text-green-500 font-semibold">{{ __('This device') }}</span>
                                                        @else
                                                            {{ __('Last active') }} {{ $session->last_active }}
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                @endif
                            </div>

                            <div class="sm:col-span-2">
                                <x-form.label for="password_logout" value='password' />
                                <x-form.input type='password' id="password_logout" name='password_logout'   required/>
                                <x-form.input-error  :message="$errors->get('password_logout')" />
                            </div>
                            <div>

                                <x-button.primary type="submit"   class="w-auto">
                                    log out other devices
                                </x-button.primary>

                            </div>

                    </div>
                </form>
            </div>
        </section>


        <!--- delete account section  --->
        <section class="bg-white container  mt-8 rounded-lg mx-auto  dark:bg-gray-900">
            <div class="max-w-2xl px-4 py-8 mx-auto lg:py-16">
                <h2 class="mb-4 text-xl font-bold text-white  dark:text-white ">Delete account</h2>
                <div class="grid gap-4 mb-4 sm:grid-cols-2 sm:gap-6 sm:mb-5">
                    <div class="sm:col-span-2" >
                        @if (session('status') === 'error-password')
                            <x-alert.alert type='danger' message="wrong password" />
                        @endif
                    </div>
                    <div class="sm:col-span-2">
                        Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain
                    </div>
                    <div>

                        <x-button.danger type="button" data-modal-target="confirm-delete-modal" data-modal-toggle="confirm-delete-modal"  class="flex item-center">
                            <svg class="w-5 h-5 mr-1 -ml-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                            Delete
                        </x-button.danger>
                    </div>
                </div>
            </div>
        </section>
    </main>





  <!-- Main modal -->
  <div id="confirm-delete-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
      <div class="relative p-4 w-full max-w-md max-h-full">
          <!-- Modal content -->
          <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
              <!-- Modal header -->
              <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                  <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                     Confirm delete your account
                  </h3>
                  <button type="button" class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="confirm-delete-modal">
                      <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                      </svg>
                      <span class="sr-only">Close modal</span>
                  </button>
              </div>
              <!-- Modal body -->
              <div class="p-4 md:p-5">
                  <form class="space-y-4" action="{{Route('profile.destroy')}}" method="post">
                    @csrf
                    @method('delete')
                    <div class="sm:col-span-2">
                        <x-form.label for="delete_password" value='password' />
                        <x-form.input type='password' id="delete_password" name='delete_password' value=""  required />
                        <x-form.input-error  :message="$errors->get('delete_password')" />
                    </div>
                    <x-button.danger type="submit"   class="flex item-center">
                        <svg class="w-5 h-5 mr-1 -ml-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                        Delete
                    </x-button.danger>

                  </form>
              </div>
          </div>
      </div>
  </div>

    </x-layouts.app>
