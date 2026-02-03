@if (session()->has('toast'))
    @php
        $toast = session('toast');

        $title = $toast['title'] ?? 'Notification';
        $message = $toast['message'] ?? '';
        $time = $toast['time'] ?? now()->format('H:i');
        $delay = (int) ($toast['delay'] ?? 4500);

        // success | info | warning | danger
        $dot = $toast['dot'] ?? 'info';

        $dotClass = match ($dot) {
            'success' => 'bg-success',
            'warning' => 'bg-warning',
            'danger'  => 'bg-danger',
            default   => 'bg-info',
        };
    @endphp

    {{-- Container top-right --}}
    <div class="position-fixed top-0 end-0 p-3" style="z-index: 1080;">
        <div
            id="glsToast"
            class="toast bootstrap-toast fade show"
            role="alert"
            aria-live="assertive"
            aria-atomic="true"
            data-bs-delay="{{ $delay }}"
        >
            <div class="toast-header">
                <!-- Bell icon (exact style from template) -->
                <svg class="me-2" width="15px" height="15px" version="1.1" viewBox="-1 0 30 30" xmlns="http://www.w3.org/2000/svg">
                    <g fill="none" fill-rule="evenodd">
                        <g transform="translate(-362 -880)" fill="var(--primary)">
                            <path d="m365 904 3-6v-8c0-4.418 3.582-8 8-8s8 3.582 8 8v8l3 6h-22zm11 4c-1.305 0-2.403-0.837-2.816-2h5.632c-0.413 1.163-1.511 2-2.816 2zm10-10v-8c0-5.522-4.478-10-10-10s-10 4.478-10 10v8l-4 8h9.101c0.463 2.282 2.48 4 4.899 4s4.436-1.718 4.899-4h9.101l-4-8z"></path>
                        </g>
                    </g>
                </svg>

                {{-- petit point couleur (success/info/warning/danger) --}}
                <span class="me-2 rounded-circle {{ $dotClass }}" style="width:8px;height:8px;display:inline-block;"></span>

                <strong class="me-auto" style="direction:ltr;">{{ $title }}</strong>
                <small class="text-body-secondary">{{ $time }}</small>

                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Fermer"></button>
            </div>

            <div class="toast-body">
                {{ $message }}
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            (function () {
                var el = document.getElementById('glsToast');
                if (!el || typeof bootstrap === 'undefined') return;

                var t = new bootstrap.Toast(el, {
                    delay: parseInt(el.getAttribute('data-bs-delay') || '4500', 10),
                    autohide: true
                });

                t.show();
            })();
        </script>
    @endpush
@endif
