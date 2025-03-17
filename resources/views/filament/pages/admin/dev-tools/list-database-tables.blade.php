<x-filament::page>
    @foreach($this->getTables() as $table)
        '{{$table}}',
    @endforeach

    {{--        <form method="POST" action="{{ route('filament.pages.database-tables-export.export') }}" class="p-6 bg-white dark:bg-gray-900 shadow-md rounded-lg">--}}
    {{--            @csrf--}}
    {{--            <div class="overflow-x-auto">--}}
    {{--                <table class="w-full table-auto border-collapse rounded-lg overflow-hidden">--}}
    {{--                    <thead class="bg-gray-200 dark:bg-gray-800 text-gray-700 dark:text-gray-300">--}}
    {{--                    <tr class="">--}}
    {{--                        <th class="p-3">--}}
    {{--                            <input type="checkbox" id="select-all" class="form-checkbox text-blue-600 dark:text-blue-400 bg-transparent border-gray-400 dark:border-gray-600 focus:ring-blue-500 dark:focus:ring-blue-400">--}}
    {{--                        </th>--}}
    {{--                        <th class="p-3 dark:text-white ">اسم الجدول</th>--}}
    {{--                    </tr>--}}
    {{--                    </thead>--}}
    {{--                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700">--}}
    {{--                    @foreach($this->getTables() as $table)--}}
    {{--                        <tr class="">--}}
    {{--                            <td class="p-3 text-center">--}}
    {{--                                <input type="checkbox" name="tables[]" value="{{ $table }}" class="table-checkbox form-checkbox text-blue-600 dark:text-blue-400 bg-transparent border-gray-400 dark:border-gray-600 focus:ring-blue-500 dark:focus:ring-blue-400">--}}
    {{--                            </td>--}}
    {{--                            <td class="p-3 text-gray-800 dark:text-gray-200">{{ $table }}</td>--}}
    {{--                        </tr>--}}
    {{--                    @endforeach--}}
    {{--                    </tbody>--}}
    {{--                </table>--}}
    {{--            </div>--}}

    {{--            <div class="mt-4 flex justify-end">--}}
    {{--                <button type="submit" class="px-6 py-2 rounded-lg shadow-md transition bg-blue-600 text-white font-semibold hover:bg-blue-700 dark:bg-blue-500 dark:hover:bg-blue-600 focus:ring focus:ring-blue-300 dark:focus:ring-blue-400">--}}
    {{--                    تصدير الجداول المحددة--}}
    {{--                </button>--}}
    {{--            </div>--}}
    {{--        </form>--}}


</x-filament::page>
