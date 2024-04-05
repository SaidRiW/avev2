<x-layout.default>
    <div class="mt-50 max-w-5x5 mx-auto">
        <div class="bg-white shadow-lg rounded-lg p-6">
           
            <div class="mt-15" id="link-display-area">
                <iframe id="link-iframe" src="http://localhost:3000/" class="w-full" style="height: 550px; border: 7px solid #cbd5e1; border-radius: 0.5rem;"></iframe>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/main.js') }}"></script>
    <script src="/socket.io/socket.io.js"></script>
</x-layout.default>