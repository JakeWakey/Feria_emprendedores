<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Editar Feria') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 text-gray-900 dark:text-gray-100">

                @if(session('success'))
                    <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
                        {{ session('success') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="mb-4 p-4 bg-red-100 text-red-800 rounded">
                        <ul class="list-disc pl-5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('ferias.update', $feria->id) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div>
                        <x-input-label for="nombre" :value="__('Nombre')" />
                        <x-text-input id="nombre" name="nombre" type="text" class="mt-1 block w-full"
                            :value="old('nombre', $feria->nombre)" autofocus />
                    </div>

                    <div>
                        <x-input-label for="descripcion" :value="__('Descripción')" />
                        <x-text-input id="descripcion" name="descripcion" type="text" class="mt-1 block w-full"
                            :value="old('descripcion', $feria->descripcion)" />
                    </div>

                    <div>
                        <x-input-label for="fecha_evento" :value="__('Fecha del Evento')" />
                        <x-text-input id="fecha_evento" name="fecha_evento" type="date" class="mt-1 block w-full"
                            :value="old('fecha_evento', $feria->fecha_evento)" />
                    </div>

                    <div>
                        <x-input-label for="lugar" :value="__('Lugar')" />
                        <x-text-input id="lugar" name="lugar" type="text" class="mt-1 block w-full"
                            :value="old('lugar', $feria->lugar)" />
                    </div>
                    <div>
                        <x-input-label for="emprendedores" :value="__('Emprendedores Participantes')" />
                        <select
                            name="emprendedores[]"
                            id="emprendedores"
                            multiple
                            class="mt-1 block w-full rounded-md bg-white text-gray-900 dark:bg-gray-700 dark:text-white border border-gray-300 dark:border-gray-600 focus:ring-indigo-500 focus:border-indigo-500"
                            size="5"
                        >
                            @foreach ($emprendedores as $emprendedor)
                                <option value="{{ $emprendedor->id }}"
                                    {{ in_array($emprendedor->id, old('emprendedores', $feria->emprendedores->pluck('id')->toArray())) ? 'selected' : '' }}>
                                    {{ $emprendedor->nombre }} ({{ $emprendedor->rubro }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex justify-center">
                        <button type="submit"
                            class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:bg-indigo-500 dark:hover:bg-indigo-600">
                            Guardar Cambios
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
