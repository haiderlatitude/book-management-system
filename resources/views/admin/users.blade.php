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
                    <b>Assign Roles to users</b>
                    <div class="text-center">
                        <form action="/assign-role" method="post" class="py-5">
                            @csrf
                            <select name="user" id="user" style="width: 100%;" class="mb-5 rounded-lg">
                                <option value="select-user" selected>Select User</option>
                                @foreach ($users as $user)
                                    <option value="{{$user->id}}">{{$user->name}}</option>
                                @endforeach
                            </select>

                            <select name="role" id="role" style="width: 100%;" class="mb-5 rounded-lg">
                                <option value="select-role" selected>Select Role</option>
                                    @foreach ($roles as $role)
                                        <option value="{{$role->name}}">{{$role->name}}</option>
                                    @endforeach
                            </select>

                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 rounded-lg px-4 py-1 text-white float-left">Assign</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="pb-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                <table style="width: 100%;" class="border-collapse border border-slate-200 rounded-lg overflow-hidden">
                        <thead>
                            <tr class="text-white bg-gray-700">
                                <th scope="col" class="text-start px-5 py-3 border border-slate-200">Sr. No.</th>
                                <th scope="col" class="text-start px-5 py-3 border border-slate-200">Name</th>
                                <th scope="col" class="text-start px-5 py-3 border border-slate-200">Roles</th>
                                <th scope="col" class="text-start px-5 py-3 border border-slate-200">Email</th>
                                @can('access')    
                                <th scope="col" class="text-start px-5 py-3 border border-slate-200">Operations</th>
                                @endcan
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td class="text-start px-5 py-3 border border-slate-200">{{$user->id}}</td>
                                <td class="text-start px-5 py-3 border border-slate-200">{{$user->name}}</td>
                                <td class="text-start px-5 py-3 border border-slate-200">
                                    @if(!($user->getRoleNames()->count() == 0))
                                        @foreach ($user->getRoleNames() as $singleRole)
                                            {{$singleRole}},
                                        @endforeach
                                    @else
                                        No Role
                                    @endif
                                </td>
                                <td class="text-start px-5 py-3 border border-slate-200">{{$user->email}}</td>
                                @can('access')
                                <td class="text-start px-5 py-3 border border-slate-200">
                                    <form action="/delete-role" method="post">
                                        @csrf
                                        <input type="hidden" name="id" id="id" value="{{$user->id}}">
                                        <button type="submit" class="bg-red-500 hover:bg-red-700 px-3 py-1 rounded-md text-white">Remove Role(s)</button>
                                    </form>
                                </td>
                                @endcan
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>