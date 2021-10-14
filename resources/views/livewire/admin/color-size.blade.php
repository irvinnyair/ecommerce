<div class="mt-4">
    
    <div class="bg-gray-300 shadow-lg rounded-lg p-6">

        <div class="mb-6">
            <x-jet-label>
                Color
            </x-jet-label>

            <div class="grid grid-cols-6 gap-6">
                @foreach ($colors as $color)
                    <label for="">
                        <input type="radio" name="color_id" value="{{ $color->id }}" wire:model.defer
                        ="color_id">
                        <span class="ml-2 text-gray-700 capitalize"> 
                            {{ __($color->name) }} 
                        </span>
                    </label>
                @endforeach
            </div>

            <x-jet-input-error for="color_id" />

        </div>

        <div>
            <x-jet-label>
                Cantidad
            </x-jet-label>
            
            <x-jet-input type="number" 
                    wire:model.defer="quantity"
                    placeholder="Ingrese una cantidad"
                    class="w-full" />
            
            <x-jet-input-error for="quantity" />

        </div>

        <div class="flex justify-end items-center mt-4">

            <x-jet-action-message class="mr-3 font-bold text-green-400" on="saved">
                Agreado
            </x-jet-action-message>

            <x-jet-button 
            wire:loading.attr="disabled"
            wire:target="save"
            wire:click="save"
            >
                Agregar
            </x-jet-button>
        </div>

    </div>

    @if ($size_colors->count())
        
        <div class="mt-8">
            <table>
                <thead>
                    <tr>
                        <th class="px-4 py-2 w-1/3">Color</th>
                        <th class="px-4 py-2 w-1/3">Cantidad</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($size_colors as $size_color)
                        {{-- Poner una llave para que livewire no se pierda y sepa que esta buscando, en el caso
                            puede aparecer un not found ya que de tantas consultas no sabe que mostrar --}}
                        <tr wire:key="product_color-{{ $size_color->pivot->id }}">
                            <td class="capitalize px-4 py-2">
                                {{ __($colors->find($size_color->pivot->color_id)->name) }}
                            </td>
                            <td class="px-4 py-2">
                                {{ $size_color->pivot->quantity }} unidades
                            </td>
                            <td class="px-4 py-2 flex">
                                <x-jet-secondary-button 
                                    class="ml-auto mr-2" 
                                    wire:click="edit({{ $size_color->pivot->id }})"
                                    wire:loading.attr="disabled"
                                    wire:target="edit({{ $size_color->pivot->id }})">
                                    Actualizar
                                </x-jet-secondary-button>
                                <x-jet-danger-button wire:click="$emit('deleteColorSize', {{ $size_color->pivot->id}})">
                                    Eliminarss
                                </x-jet-danger-button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    @endif

    {{-- Modal del color prodcuto --}}
    <x-jet-dialog-modal wire:model="open">

        <x-slot name="title">
            Editar Color
        </x-slot>

        <x-slot name="content">
            <div class="mb-4">
                <x-jet-label>
                    Color
                </x-jet-label>

                <select class="form-control w-full" wire:model="pivot_color_id">
                    <option value="">Seleccione color</option>
                    @foreach ($colors as $color)
                    <option value="{{$color->id}}">{{  ucfirst(__($color->name)) }}</option>
                    @endforeach
                </select>

            </div>

            <div>

                <x-jet-label>
                    Cantidad
                </x-jet-label>

                <x-jet-input class="w-full" type="number" placeholder="Ingrese una cantidad" wire:model="pivot_quantity"/>

            </div>

        </x-slot>

        <x-slot name="footer">

            <x-jet-secondary-button 
                wire:click="$set('open', false)">
                Cancelar
            </x-jet-secondary-button>

            <x-jet-button 
                wire:click="update"
                wire:loading.attr="disabled"
                wire:target="update">
                Actualizar
            </x-jet-button>

        </x-slot>

    </x-jet-dialog-modal>

</div>
