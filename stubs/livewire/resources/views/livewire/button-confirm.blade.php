<div class="m-20">
    <button x-model="password" wire:click="delete"
    wire:confirm.prompt="{password: are you sure confirm|delete}">
        text
    </button>

    <span x-text='password' >

    </span>
</div>
