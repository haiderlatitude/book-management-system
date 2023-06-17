<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            @if(session()->has('message'))
                {{session('message')}}
            @endif
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                <table style="width: 100%;" class="border-collapse border border-slate-200 rounded-lg overflow-hidden">
                        <thead>
                            <tr class="text-white bg-gray-700">
                                <th scope="col" class="text-start px-5 py-3 border border-slate-200">Sr. No.</th>
                                <th scope="col" class="text-start px-5 py-3 border border-slate-200">Roles</th>
                                <th scope="col" class="text-start px-5 py-3 border border-slate-200">Permissions</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($roles as $role)
                            <tr>
                                <td class="text-start px-5 py-3 border border-slate-200">{{$role->id}}</td>
                                <td class="text-start px-5 py-3 border border-slate-200">
                                    {{$role->name}}
                                </td>
                                <td class="text-start px-5 py-3 border border-slate-200">
                                    @if(!(count($role->permissions)) == 0)
                                        @foreach($role->permissions as $permission)
                                            {{$permission->name}},
                                        @endforeach
                                    @else
                                            No permissions.
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>