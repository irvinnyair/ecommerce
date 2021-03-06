<div>

    <header class="bg-white shadow-lg">
    
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">

            <div class="flex justify-between items-center">

                <h1 class="font-semibold text-xl text-gray-800 leading-tight">
                    Productos
                </h1>

                <x-jet-danger-button wire:click="$emit('deleteProduct')">
                    Eliminar
                </x-jet-danger-button>

            </div>

        </div>

    </header>
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12 text-gray-700">
    
        <h1 class="text-3xl text-center font-semibold mb-8">Editar nuevo producto</h1>
    
        <div class="mb-4" wire:ignore>
            <form action="{{route('admin.products.files', $product)}}"
                method="POST"
    
                class="dropzone"
                id="my-awesome-dropzone">
            </form>
        </div>
    
        @if ($product->images->count()) 
    
            <section class="bg-white shadow-lg rounded-lg p-6 mb-4">
    
                <h1 class="text-2xl text-center font-semibold mb-2">Imagenes del producto</h1>
    
                <ul class="flex flex-wrap">
    
                    @foreach ($product->images as $image)
                        
                        <li class="relative" wire:key="image-{{ $image->id }}">
                            <img class="w-32 h-20 object-cover" src="{{ Storage::url($image->url) }}" alt="">
                            <x-jet-danger-button class="absolute right-2 top-2" 
                            wire:click="deleteImage({{$image->id}})"
                            wire:loading.attr="disabled"
                            wire:target="deleteImage({{$image->id}})">
                                x
                            </x-jet-danger-button>
                        </li>
    
                    @endforeach
    
                </ul>
    
            </section>
    
       @endif
    
       @livewire('admin.status-product', ['product' => $product], key('status-product-'.$product->id))
    
        <div class="bg-white shadow-lg rounded-lg p-6">
    
            <div class="grid grid-cols-2 gap-6 mb-4">
    
                {{-- Categoria --}}
                <div>
                    <x-jet-label value="Categor??as" />
                    <select class="w-full form-control" name="" id="" wire:model="category_id">
        
                        <option value="" selected disabled>Seleccione una categor??a</option>
        
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"> {{ $category->name }} </option>
                        @endforeach
                    </select>
        
                    <x-jet-input-error for="category_id" />
        
                </div>
        
                {{-- Subcategoria --}}
                <div>
                    <x-jet-label value="Subcategor??a" />
                    <select class="w-full form-control" name="" id="" wire:model="product.subcategory_id">
        
                        <option value="" selected disabled>Seleccione una categor??a</option>
        
                        @foreach ($subcategories as $subcategory)
                            <option value="{{ $subcategory->id }}"> {{ $subcategory->name }} </option>
                        @endforeach
                    </select>
                    
                    <x-jet-input-error for="product.subcategory_id" />
        
                </div>
        
            </div>
        
            <div class="mb-4">
                <x-jet-label value="Nombre" />
                <x-jet-input type="text"    
                            placeholder="Nombre del producto"
                            class="w-full"
                            wire:model="product.name" />
                
                <x-jet-input-error for="product.name" />
        
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
        
        
            {{-- Descripci??n --}}
            <div class="mb-4">
        
                <div wire:ignore>
                    <x-jet-label value="Descripci??n" />
                    <textarea class="w-full form-control" rows="4"
                            wire:model="product.description"
                            x-data 
                            x-init="ClassicEditor
                            .create( $refs.miEditor )
                            .then(function(editor){
                                editor.model.document.on('change:data', () => {
                                    @this.set('product.description', editor.getData())
                                })
                            })
                            .catch( error => {
                                console.error( error );
                            } );" x-ref="miEditor">
                    </textarea>
                </div>
        
                <x-jet-input-error for="product.description" />
        
            </div>
        
            <div class="grid grid-cols-2 gap-6 mb-4">
        
                <div class="">
        
                    <x-jet-label value="Marca" />
                    <select class="form-control w-full" wire:model="product.brand_id">
                        <option value="" selected disabled>Seleccione una marca</option>
            
                        @foreach ($brands as $brand)
                            
                            <option value="{{ $brand->id }}"> {{ $brand->name }} </option>
            
                        @endforeach
            
                    </select>
        
                    <x-jet-input-error for="product.brand_id" />
        
                </div>
        
                <div>
                    <x-jet-label value="Precio" />
                    <x-jet-input type="number"   
                            wire:model="product.price"
                            placeholder="Precio del producto"
                            class="w-full"
                            step=".01"/>
        
                    <x-jet-input-error for="product.price" />
        
                </div>
        
            </div>
        
        
            
            @if ($this->subcategory)
                @if (!$this->subcategory->color && !$this->subcategory->size)
                    
                <div>
                    <x-jet-label value="Cantidad" />
                    <x-jet-input type="number"
                            wire:model="product.quantity"
                            placeholder="Precio del producto"
                            class="w-full"/>
                    
                            <x-jet-input-error for="product.quantity" />
                </div>
        
                @endif
            @endif
        
        
        
            <div class="flex justify-end items-center mt-4">
    
                <x-jet-action-message class="mr-3 font-bold text-green-400" on="saved">
                    Datos actualizados
                </x-jet-action-message>
    
                <x-jet-button 
                wire:loading.attr="disabled"
                wire:target="save"
                wire:click="save"
                >
                    Actualizar
                </x-jet-button>
            </div>
    
        </div>
    
        @if ($this->subcategory)
            
            @if ($this->subcategory->size)
    
                @livewire('admin.size-product', ['product' => $product], key('size-producr' . $product->id))
                
            @elseif($this->subcategory->color)
    
                @livewire('admin.color-product', ['product' => $product], key('color-producr' . $product->id))
    
            @endif
    
        @endif
    
    </div>

    @push('script')
            <script>
                // "myAwesomeDropzone" is the camelized version of the HTML element's ID
                Dropzone.options.myAwesomeDropzone = {
                    headers: {
                        'X-CSRF-TOKEN' : "{{ csrf_token() }}"
                    },
                    dictDefaultMessage: 'Arrastre sus imagenes al recuadro',
                    acceptedFiles: 'image/*', //que archivo se recibe
                    paramName: "file", // The name that will be used to transfer the file
                    maxFilesize: 2, // MB
                    complete: function(file){
    
                        this.removeFile(file)
    
                    },
                    queuecomplete: function(){
    
                        Livewire.emit('refreshProduct')
    
                    }
                };
    
    
                //SizeProduct
                Livewire.on('deleteSize', sizeId =>{
                    Swal.fire({
                    title: 'Estas seguro(a)?',
                    text: "No podras revetir esta acci??n!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, eliminar!',
                    cancelButtonText: 'Cancelar'
                    }).then((result) => {
                    if (result.isConfirmed) {
    
                            Livewire.emitTo('admin.size-product','delete', sizeId);
                            Swal.fire(
                            'Eliminado!',
                            'La informaci??n se ha eliminado correctamente.',
                            'success'
                            )
                        }
                    })
                })
    
                //ColorProduct
                Livewire.on('deletePivot', pivot =>{
                    Swal.fire({
                    title: 'Estas seguro(a)?',
                    text: "No podras revetir esta acci??n!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, eliminar!',
                    cancelButtonText: 'Cancelar'
                    }).then((result) => {
                    if (result.isConfirmed) {
    
                            Livewire.emitTo('admin.color-product','delete', pivot);
                            Swal.fire(
                            'Eliminado!',
                            'La informaci??n se ha eliminado correctamente.',
                            'success'
                            )
                        }
                    })
                })
    
                Livewire.on('deleteColorSize', pivot =>{
                    Swal.fire({
                    title: 'Estas seguro(a)?',
                    text: "No podras revetir esta acci??n!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, eliminar!',
                    cancelButtonText: 'Cancelar'
                    }).then((result) => {
                    if (result.isConfirmed) {
    
                            Livewire.emitTo('admin.color-size','delete', pivot);
                            Swal.fire(
                            'Eliminado!',
                            'La informaci??n se ha eliminado correctamente.',
                            'success'
                            )
                        }
                    })
                })

                Livewire.on('deleteProduct', () =>{
                    Swal.fire({
                    title: 'Estas seguro(a)?',
                    text: "No podras revetir esta acci??n!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, eliminar!',
                    cancelButtonText: 'Cancelar'
                    }).then((result) => {
                    if (result.isConfirmed) {
    
                            Livewire.emitTo('admin.edit-product','delete');
                            Swal.fire(
                            'Eliminado!',
                            'La informaci??n se ha eliminado correctamente.',
                            'success'
                            )
                        }
                    })
                })

            </script>
        @endpush    

</div>
