<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white flex items-center justify-center overflow-hidden shadow-sm sm:rounded-lg">

                @can('isAdmin')
                    @php $greeting = " Admin!"; @endphp
                @endcan

                @can('isEditor')
                    @php $greeting = " Moderator!"; @endphp
                @endcan

                @can('isUser')
                    @php $greeting = "User!"; @endphp
                @endcan


                    <div class="p-10 text-2xl text-gray-900">
                        {!! __("Successfully logged in! Hello <strong>$greeting</strong>") !!}
                    </div>


            </div>
        </div>
    </div>
</x-app-layout>
