<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-[#1890FF] border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-[#40A9FF] focus:bg-[#40A9FF] active:bg-[#006EDC] focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
