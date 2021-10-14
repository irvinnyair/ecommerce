<div>
 
    <x-jet-form-section submit="save" class="mb-6">

        <x-slot name="title">
            Crear Categoría
        </x-slot>

        <x-slot name="description">

            Complete la informacion para la nueva categoría

        </x-slot>

        <x-slot name="form">
            
            <div class="col-span-6 sm:col-span-4">

                <x-jet-label>
                    Nombre
                </x-jet-label>

                <x-jet-input type="text" class="w-full mt-1" wire:model="createForm.name"/>

                <x-jet-input-error for="createForm.name" />

            </div>

            <div class="col-span-6 sm:col-span-4">

                <x-jet-label>
                    Slug
                </x-jet-label>

                <x-jet-input type="text" disabled class="w-full mt-1 bg-gray-200" wire:model="createForm.slug"/>

                <x-jet-input-error for="createForm.slug" />

            </div>

            <div class="col-span-6 sm:col-span-4">

                <x-jet-label>
                    ícono
                </x-jet-label>

                <x-jet-input type="text" class="w-full mt-1" wire:model.defer="createForm.icon"/>

                <x-jet-input-error for="createForm.icon" />

            </div>

            <div class="col-span-6 sm:col-span-4">

                <x-jet-label>
                    Marca
                </x-jet-label>

                <div class="grid grid-cols-4">

                    @foreach ($brands as $brand)

                    <x-jet-label>
                        
                        <x-jet-checkbox wire:model.defer="createForm.brands" name="brands[]"
                        value="{{ $brand->id }}"/>
                        {{ $brand->name }}

                    </x-jet-label>
                        
                    @endforeach

                </div>

                <x-jet-input-error for="createForm.brands" />

            </div>

            <div class="col-span-6 sm:col-span-4">

                <x-jet-label>
                    Imagen
                </x-jet-label>

                <x-jet-input type="file" class="w-full mt-1" wire:model="createForm.image" accept="image/*" id="{{$rand}}"/>

                <x-jet-input-error for="createForm.image" />

            </div>

        </x-slot>
        

        <x-slot name="actions">

            <x-jet-action-message class="mr-3" on="saved">
                Registro creado
            </x-jet-action-message>

            <x-jet-button>
                Guardar
            </x-jet-button>

        </x-slot>

    </x-jet-form-section>

    <x-jet-action-section>

        <x-slot name="title">
            Lista de categorías
        </x-slot>

        <x-slot name="description">
            aa
        </x-slot>

        <x-slot name="content">
            
            <table class="text-gray-700">
                <thead class="border-b border-gray-700">
                    <tr class="text-left">
                        <th class="py-2 w-full">Nombre</th>
                        <th class="py-2 ">Accion</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-red-300">
                    @foreach ($categories as $category)
                        <tr>
                            <td class="py-2">
                                <span class="inline-block w-8 text-center mr-2">
                                    {!!$category->icon !!}
                                </span>
                                <span class="uppercase">
                                    {{$category->name}}
                                </span>
                            </td>
                            <td class="py-2">
                                <div class="flex divide-x divide-gray-300 font-semibold">
                                    <a class="pr-2 hover:text-blue-600 cursor-pointer" wire:click="edit('{{ $category->slug }}')">Editar</a>
                                    <a class="pl-2 hover:text-red-600 cursor-pointer" wire:click="$emit('deleteCategory', '{{ $category->slug }}')">Eliminar</a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </x-slot>

    </x-jet-action-section>

    <x-jet-dialog-modal wire:model="editForm.open">

        <x-slot name="title">
            Editar categoría
        </x-slot>

        <x-slot name="content">

            <div class="space-y-3">
                <div class="">

                    <x-jet-label>
                        Nombre
                    </x-jet-label>
    
                    <x-jet-input type="text" class="w-full mt-1" wire:model="editForm.name"/>
    
                    <x-jet-input-error for="editForm.name" />
    
                </div>
    
                <div class="">
    
                    <x-jet-label>
                        Slug
                    </x-jet-label>
    
                    <x-jet-input type="text" disabled class="w-full mt-1 bg-gray-200" wire:model="editForm.slug"/>
    
                    <x-jet-input-error for="editForm.slug" />
    
                </div>
    
                <div class="">
    
                    <x-jet-label>
                        ícono
                    </x-jet-label>
    
                    <x-jet-input type="text" class="w-full mt-1" wire:model.defer="editForm.icon"/>
    
                    <x-jet-input-error for="editForm.icon" />
    
                </div>
    
                <div class="">
    
                    <x-jet-label>
                        Marca
                    </x-jet-label>
    
                    <div class="grid grid-cols-4">
    
                        @foreach ($brands as $brand)
    
                        <x-jet-label>
                            
                            <x-jet-checkbox wire:model.defer="editForm.brands" name="brands[]"
                            value="{{ $brand->id }}"/>
                            {{ $brand->name }}
    
                        </x-jet-label>
                            
                        @endforeach
    
                    </div>
    
                    <x-jet-input-error for="editForm.brands" />
    
                </div>
    
                <div class="">
    
                    <x-jet-label>
                        Imagen
                    </x-jet-label>
    
                    <x-jet-input type="file" class="w-full mt-1" wire:model="editImage" accept="image/*" id="{{$rand}}"/>
    
                    <x-jet-input-error for="editImage<" />
    
                </div>
            </div>

        </x-slot>

        <x-slot name="footer">
        </x-slot>

    </x-jet-dialog-modal>

</div>
