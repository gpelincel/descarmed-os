@switch($status)
    @case(1)
        <span
            class="bg-gray-100 text-gray-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-gray-700 dark:text-gray-300">
            <i class="fi fi-rr-calendar-clock"></i>
            Agendado
        </span>
    @break

    @case(2)
        <span
            class="bg-yellow-100 text-yellow-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-yellow-900 dark:text-yellow-300">
            <i class="fi fi-rr-time-forward"></i>
            Em andamento
        </span>
    @break

    @case(3)
        <span
            class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-green-900 dark:text-green-300">
            <i class="fi fi-rs-check-circle"></i>
            Concluída
        </span>
    @break

    @default
@endswitch
