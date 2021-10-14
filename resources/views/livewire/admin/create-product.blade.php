<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12 text-gray-700">
    
    <h1 class="text-3xl text-center font-semibold mb-8">Crear un nuevo producto</h1>

    <div class="grid grid-cols-2 gap-6 mb-4">

        {{-- Categoria --}}
        <div>
            <x-jet-label value="Categorías" />
            <select class="w-full form-control" name="" id="" wire:model="category_id">

                <option value="" selected disabled>Seleccione una categoría</option>

                @foreach ($categories as $category)
                    <option value="{{ $category->id }}"> {{ $category->name }} </option>
                @endforeach
            </select>

            <x-jet-input-error for="category_id" />

        </div>

        {{-- Subcategoria --}}
        <div>
            <x-jet-label value="Subcategoría" />
            <select class="w-full form-control" name="" id="" wire:model="subcategory_id">

                <option value="" selected disabled>Seleccione una categoría</option>

                @foreach ($subcategories as $subcategory)
                    <option value="{{ $subcategory->id }}"> {{ $subcategory->name }} </option>
                @endforeach
            </select>
            
            <x-jet-input-error for="subcategory_id" />

        </div>

    </div>

    <div class="mb-4">
        <x-jet-label value="Nombre" />
        <x-jet-input type="text"    
                    placeholder="Nombre del producto"
                    class="w-full"
                    wire:model="name" />
        
        <x-jet-input-error for="name" />

    </div>

    <div class="mb-4">
        <x-jet-label value="Slug" />
        <x-jet-input type="text"   
                    disabled 
                    placeholder="Slug del producto"
                    class="w-full bg-gray-200" 
                    wire:model="slug"/>
        
        <x-jet-input-error for="slug" />

    </div>


    {{-- Descripción --}}
    <div class="mb-4">

        <div wire:ignore>
            <x-jet-label value="Descripción" />
            <textarea class="w-full form-control" rows="4"
                    x-data x-init="ClassicEditor
                    .create( $refs.miEditor )
                    .then(function(editor){
                        editor.model.document.on('change:data', () => {
                            @this.set('description', editor.getData())
                        })
                    })
                    .catch( error => {
                        console.error( error );
                    } );" x-ref="miEditor">
            </textarea>
        </div>

        <x-jet-input-error for="category_id" />

    </div>

    <div class="grid grid-cols-2 gap-6 mb-4">

        <div class="">

            <x-jet-label value="Marca" />
            <select class="form-control w-full" wire:model="brand_id">
                <option value="" selected disabled>Seleccione una marca</option>
    
                @foreach ($brands as $brand)
                    
                    <option value="{{ $brand->id }}"> {{ $brand->name }} </option>
    
                @endforeach
    
            </select>

            <x-jet-input-error for="brand_id" />

        </div>

        <div>
            <x-jet-label value="Precio" />
            <x-jet-input type="number"   
                    wire:model="price"
                    placeholder="Precio del producto"
                    class="w-full"
                    step=".01"/>

            <x-jet-input-error for="price" />

        </div>

    </div>


    @if ($subcategory_id)
    
        @if (!$this->subcategory->color && !$this->subcategory->size)
            
        <div>
            <x-jet-label value="Cantidad" />
            <x-jet-input type="number"
                    wire:model="quantity"
                    placeholder="Precio del producto"
                    class="w-full"/>
            
                    <x-jet-input-error for="quantity" />
        </div>

        @endif

    @endif

    <div class="flex mt-4">
        <x-jet-button 
        class="ml-auto" 
        wire:loading.attr="disabled"
        wire:target="save"
        wire:click="save"
        >
            Guardar
        </x-jet-button>
    </div>

</div>
