 <!--- delete account section  --->
 <section class="bg-white container  mt-8 rounded-lg mx-auto  dark:bg-gray-900">
     <div class="max-w-2xl px-4 py-8 mx-auto lg:py-16">
         <h2 class="mb-4 text-xl font-bold text-white  dark:text-white ">Delete account</h2>
         <div class="grid gap-4 mb-4 sm:grid-cols-2 sm:gap-6 sm:mb-5">
             <div class="sm:col-span-2">

             </div>
             <div class="sm:col-span-2">
                 Once your account is deleted, all of its resources and data will be permanently deleted. Before
                 deleting your account, please download any data or information that you wish to retain
             </div>
             <div x-data="{ delete_model: false }">
                 <x-button.danger type="button" class="flex item-center" x-on:click="delete_model = ! delete_model">
                     <svg class="w-5 h-5 mr-1 -ml-1" fill="currentColor" viewBox="0 0 20 20"
                         xmlns="http://www.w3.org/2000/svg">
                         <path fill-rule="evenodd"
                             d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                             clip-rule="evenodd"></path>
                     </svg>
                     Delete
                 </x-button.danger>

                 <x-model title="confirm password for delete your Account" show="delete_model"
                     x-on:click="delete_model = ! delete_model">
                     <div class="p-4 md:p-5">
                         <form wire:submit="delete">
                             @csrf
                             <div>
                                 @if ($delete_status != [])
                                     <x-alert.alert :type="$delete_status['type']" :message="$delete_status['message']" />
                                 @endif
                             </div>
                             <div class="sm:col-span-2 mb-4">
                                 <x-form.label for="password_delete" value='password' />
                                 <x-form.input type='password' wire:model="password_delete" id="password_delete"
                                     name='password_delete' required fouce />
                                 @error('password_delete')
                                     <X-alert.alert type="danger" :message="$message" />
                                 @enderror


                             </div>
                             <x-button.danger type="submit" class="mt-4">

                                 Delete
                             </x-button.danger>
                         </form>


                     </div>
                 </x-model>
             </div>
             <div>


             </div>
         </div>
     </div>
 </section>
