<div class="mb-4 border-b border-gray-200 dark:border-gray-700 mx-4 lg:mx-12">
    <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="default-tab" data-tabs-toggle="#default-tab-content" role="tablist">
        <li class="me-2" role="presentation">
            <button class="inline-block p-4 border-b-2 rounded-t-lg" id="profile-tab" data-tabs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Ordens de Serviço</button>
        </li>
        <li class="me-2" role="presentation">
            <button class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" id="equipamento-tab" data-tabs-target="#equipamento" type="button" role="tab" aria-controls="equipamento" aria-selected="false">Equipamentos</button>
        </li>
    </ul>
</div>
<div id="default-tab-content">
    <div class="hidden rounded-lg" id="profile" role="tabpanel" aria-labelledby="profile-tab">
        <x-os-table :ordens="$ordens"></x-os-table>
    </div>
    <div class="hidden rounded-lg" id="equipamento" role="tabpanel" aria-labelledby="equipamento-tab">
        <x-equipamento-table :equipamentos="$equipamentos"></x-equipamento-table>
    </div>
</div>