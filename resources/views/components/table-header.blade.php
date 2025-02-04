<thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
    <tr>
        <th scope="col" class="px-4 py-4">#</th>
        @foreach ($headers as $header)
            <th scope="col" class="px-4 py-4">{{$header}}</th>
        @endforeach
        <th scope="col" class="px-4 py-3">
            <span class="sr-only">Actions</span>
        </th>
    </tr>
</thead>
