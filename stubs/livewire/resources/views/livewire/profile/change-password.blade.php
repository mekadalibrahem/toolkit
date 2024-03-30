     <!--- update password section  --->
     <section class="bg-white container  mt-8 rounded-lg mx-auto  dark:bg-gray-900">
         <div class="max-w-2xl px-4 py-8 mx-auto lg:py-16">
             <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">change password</h2>
             @if ($edit_passowrd != '')
                 <x-alert.alert type='success' message="password updated" />
             @endif

             <form wire:submit="edit">
                 @csrf
                 <div class="grid gap-4 mb-4 sm:grid-cols-2 sm:gap-6 sm:mb-5">
                     <div class="sm:col-span-2">
                         <x-form.label for="password" value='password' />
                         <x-form.input type='password' wire:model="password" id="password" name='password'
                             value="" required />
                         @error('password')
                             <x-alert.alert type="danger" :message="$message" />
                         @enderror
                     </div>
                     <div class="sm:col-span-2">
                         <x-form.label for="new_password" value='new password' />
                         <x-form.input type='password' wire:model="new_password" id="new_password" name='new_password'
                             value="" />
                         @error('new_password')
                             <x-alert.alert type="danger" :message="$message" />
                         @enderror
                     </div>
                     <div class="sm:col-span-2">
                         <x-form.label for="confirm_password" value='confirm password' />
                         <x-form.input type='password' wire:model="confirm_password" id="confirm_password"
                             name='confirm_password' value="" />
                         @error('confirm_password')
                             <x-alert.alert type="danger" :message="$message" />
                         @enderror
                     </div>
                     <div class=" flex  items-center  space-x-4">
                         <x-button.primary type="submit" class="w-auto">
                             Change password
                         </x-button.primary>

                     </div>
                 </div>
             </form>
         </div>
     </section>
