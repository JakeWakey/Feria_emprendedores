<x-app-layout>
    <x-slot name="header">
    <div class="flex flex-row justify-between items-center">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Emprendedores') }}
        </h2>
        <a
        style="border: 1px solid;"
        class="hover:bg-indigo-700 bg-indigo-600  text-gray-800 border-gray-800 dark:text-gray-200 dark:border-gray-200 rounded-lg p-2 transition-all"
        href="{{route('emprendedores.create')}}"
        >
            {{ __('Nuevo Emprendedor') }}
        </a>
        </div>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                @foreach ($emprendedores as $index => $emprendedor)
                    <div class="flex flex-row items-center justify-between pr-8">
                    <div class="p-4 flex flex-col gap-2">
                        <p class="font-bold">{{$emprendedor->nombre}}</p>
                        <p>{{$emprendedor->telefono}} - {{$emprendedor->rubro}}</p>
                        @if($emprendedor->ferias->count())
                            <div class="flex flex-wrap gap-2 mt-1">
                                @foreach($emprendedor->ferias as $feria)
                                    <span class="text-sm bg-indigo-200 text-indigo-900 px-2 py-1 rounded">
                                        {{ $feria->nombre }}
                                    </span>
                                @endforeach
                            </div>
                        @else
                            <p class="text-sm text-gray-400 italic">Sin ferias asignadas</p>
                        @endif
                    </div>
                    <div class="flex flex-row gap-2">
                    <a
                    href="{{route('emprendedores.edit', $emprendedor->id)}}"
                        style="border: 1px solid;"
                    class="hover:dark:bg-gray-200 hover:dark:text-gray-800 text-gray-800 border-gray-800 dark:text-gray-200 dark:border-gray-200 rounded-lg p-2 transition-all h-full"
                    >Edit</a>
                    <form action="{{ route('emprendedores.destroy', $emprendedor->id) }}" method="POST" style="">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="bg-red-600 text-gray-200 rounded-lg p-2 transition-all"
                                style="border: 1px solid;">
                            Delete
                        </button>
                    </form>
                    </div>
                    </div>
                @if ($index != count($emprendedores) - 1)
                <hr></hr>
                @endif
                @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
