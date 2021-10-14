<div class="bg-white shadow-lg rounded-lg p-6 mb-4">
   
    <p class="text-2xl text-center font-semibold mb-2">Estado del producto</p>

    <div class="flex">
        <label for="" class="mr-4">
            <input wire:model.defer="status" type="radio" name="status" value="1">
            Estado del producto en: Borrador
        </label>
        <label for="">
            <input wire:model.defer="status" type="radio" name="status" value="2">
            Estado del producto en: Publicado
        </label>
    </div>

    <div class="flex justify-end items-center">

        <x-jet-action-message class="mr-3" on="saved">
            Actualizado
        </x-jet-action-message>

        <x-jet-button class="" wire:click="save" wire:loading.attr="disabled" wire:targer="save">
            Actualizar
        </x-jet-button>

    </div>
   
</div>
