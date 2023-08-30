<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Inbox') }}
        </h2>
    </x-slot>



    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        

            <div class="bg-gray dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                <table class="table table-dark table-striped">
                        <thead>
                            <tr>
                                <th>Full Name</th>
                                <th>Telephone</th>
                                <th>Email</th>
                                <th>Message</th>
                                <th>Date</th>
                                <th>OP</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($inbox as $inbox)
                            <tr>
                                <td>{{ $inbox->fullname }}</td>
                                <td>{{ $inbox->telephone }}</td>
                                <td>{{ $inbox->email }}</td>
                                <td>{{ $inbox->message }}</td>
                                <td>{{ $inbox->created_at }}</td>
                                <td><button type="button" class="btn btn-primary">Primary</button></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
         
        </div>

    </div>
</x-app-layout>