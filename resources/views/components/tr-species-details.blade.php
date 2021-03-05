<tr class="border-b">
    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
        Ladinakeelne nimi
    </th>
    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 bg-white divide-y divide-gray-200">
        <i>{{ $species->latin_name }}</i>
    </td>
</tr>
<tr class="border-b">
    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
        Ingliskeelne nimi
    </th>
    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 bg-white divide-y divide-gray-200">
        {{ $species->eng_name }}
    </td>
</tr>
<x-tr-species-fixed :species="$species"/>