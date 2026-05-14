<div class="relative" x-data="{ open: @entangle('open') }">

    {{-- Bell Button --}}
    <button x-on:click="open = !open"
        style="position: relative; display: inline-flex; align-items: center; justify-content: center; width: 36px; height: 36px; border-radius: 8px; transition: background 0.15s;"
        onmouseenter="this.style.background=document.documentElement.classList.contains('dark') ? '#242427' : '#FAFAFA'"
        onmouseleave="this.style.background='transparent'">

        <svg style="width:20px;height:20px;color:#9ca3af" fill="none" stroke="currentColor" stroke-width="2"
            viewBox="0 0 24 24">

            <path
                d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />

        </svg>

        {{-- Badge --}}
        @if ($this->unreadCount > 0)
            <span
                style="
                    position: absolute;
                    top: -4px;
                    right: -4px;
                    min-width: 15px;
                    height: 15px;
                    background: #ef4444;
                    color: white;
                    font-size: 10px;
                    font-weight: 700;
                    border-radius: 9999px;
                    display: inline-flex;
                    align-items: center;
                    justify-content: center;
                    padding: 0 4px;
                    line-height: 1;
                    z-index: 10;">

                {{ $this->unreadCount > 9 ? '9+' : $this->unreadCount }}

            </span>
        @endif

    </button>

    {{-- Dropdown Panel --}}
    <div x-show="open" x-on:click.outside="open = false" x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 translate-y-1" x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 translate-y-1"
        class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700"
        style="
            display: none;
            position: absolute;
            right: 1;
            top: 48px;
            width: 340px;
            min-width: 340px;
            border-radius: 12px;
            z-index: 50;
            overflow: hidden;">

        {{-- Header --}}
        <div style="display:flex;align-items:center;justify-content:space-between;padding:14px 16px;"
            class="border-b border-gray-200 dark:border-gray-700">

            <div style="display:flex;align-items:center;gap:8px;">

                <span style="font-weight:600;font-size:14px;" class="text-gray-900 dark:text-white">

                    Notifikasi

                </span>

                @if ($this->unreadCount > 0)
                    <span
                        style="background:#fef2f2;color:#ef4444;font-size:11px;font-weight:600;padding:2px 8px;border-radius:9999px;">

                        {{ $this->unreadCount }} baru

                    </span>
                @endif

            </div>

            @if ($this->unreadCount > 0)
                <button wire:click="markAllAsRead"
                    style="font-size:12px;font-weight:500;color:#60a5fa;background:none;border:none;cursor:pointer;"
                    onmouseenter="this.style.textDecoration='underline'"
                    onmouseleave="this.style.textDecoration='none'">

                    Tandai semua dibaca

                </button>
            @endif

        </div>

        {{-- List Notifikasi --}}
        <div style="max-height:320px;overflow-y:auto;">

            @forelse($this->notifications as $notif)
                <a href="{{ route('filament.admin.resources.kos-notifications.view', $notif) }}"
                    style="display:flex;align-items:flex-start;gap:12px;padding:14px 16px;transition:background 0.15s;"
                    class="border-b border-gray-200 dark:border-gray-700"
                    onmouseenter="this.style.background=document.documentElement.classList.contains('dark') ? '#242427' : '#FAFAFA'"
                    onmouseleave="this.style.background='transparent'">

                    {{-- Icon --}}
                    <div style="flex-shrink:0;margin-top:2px;">

                        @if ($notif->type === 'danger')
                            <span
                                style="display:flex;width:36px;height:36px;align-items:center;justify-content:center;border-radius:9999px;background:#fef2f2;">

                                <svg style="width:16px;height:16px;color:#ef4444;" fill="none" stroke="#ef4444"
                                    stroke-width="2" viewBox="0 0 24 24">

                                    <circle cx="12" cy="12" r="10" />
                                    <line x1="12" y1="8" x2="12" y2="12" />
                                    <line x1="12" y1="16" x2="12.01" y2="16" />

                                </svg>

                            </span>
                        @elseif($notif->type === 'warning')
                            <span
                                style="display:flex;width:36px;height:36px;align-items:center;justify-content:center;border-radius:9999px;background:#fefce8;">

                                <svg style="width:16px;height:16px;" fill="none" stroke="#f59e0b" stroke-width="2"
                                    viewBox="0 0 24 24">

                                    <path
                                        d="M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z" />

                                    <line x1="12" y1="9" x2="12" y2="13" />
                                    <line x1="12" y1="17" x2="12.01" y2="17" />

                                </svg>

                            </span>
                        @else
                            <span
                                style="display:flex;width:36px;height:36px;align-items:center;justify-content:center;border-radius:9999px;background:#eff6ff;">

                                <svg style="width:16px;height:16px;" fill="none" stroke="#3b82f6" stroke-width="2"
                                    viewBox="0 0 24 24">

                                    <circle cx="12" cy="12" r="10" />
                                    <line x1="12" y1="8" x2="12" y2="12" />
                                    <line x1="12" y1="16" x2="12.01" y2="16" />

                                </svg>

                            </span>
                        @endif

                    </div>

                    {{-- Content --}}
                    <div style="flex:1;min-width:0;">

                        <p style="font-size:13px;font-weight:600;margin:0 0 3px;"
                            class="text-gray-900 dark:text-gray-100">

                            {{ $notif->title }}

                        </p>

                        <p style="font-size:12px;margin:0 0 4px;line-height:1.5;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;"
                            class="text-gray-600 dark:text-gray-400">

                            {{ $notif->message }}

                        </p>

                        <p style="font-size:11px;margin:0;" class="text-gray-400 dark:text-gray-500">

                            {{ $notif->created_at->locale('id')->diffForHumans() }}

                        </p>

                    </div>

                    {{-- Tombol Tandai Dibaca --}}
                    <button wire:click="markAsRead({{ $notif->id }})"
                        style="flex-shrink:0;margin-top:4px;padding:4px;border-radius:9999px;border:none;background:none;cursor:pointer;color:#4b5563;transition:all 0.15s;"
                        onmouseenter="this.style.background='#064e3b';this.style.color='#34d399'"
                        onmouseleave="this.style.background='transparent';this.style.color='#4b5563'"
                        title="Tandai dibaca">

                        <svg style="width:14px;height:14px;" fill="none" stroke="currentColor" stroke-width="2.5"
                            viewBox="0 0 24 24">

                            <polyline points="20 6 9 17 4 12" />

                        </svg>

                    </button>

                </a>

            @empty

                <div style="padding:60px 16px;text-align:center;">

                    <div style="margin:0 auto 16px;width:64px;height:64px;border-radius:9999px;display:flex;align-items:center;justify-content:center;"
                        class="bg-gray-100 dark:bg-gray-700">

                        <svg style="width:32px;height:32px;color:#4b5563;" fill="none" stroke="currentColor"
                            stroke-width="1.5" viewBox="0 0 24 24">

                            <path
                                d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />

                        </svg>

                    </div>

                    <p style="font-size:15px;font-weight:600;margin:0 0 4px;"
                        class="text-gray-700 dark:text-gray-300">

                        Tidak ada notifikasi baru

                    </p>

                    <p style="font-size:13px;margin:0;" class="text-gray-500">

                        Semua pembayaran dalam kondisi baik

                    </p>

                </div>
            @endforelse

        </div>

        {{-- Footer --}}
        @php $totalCount = \App\Models\KosNotification::count(); @endphp

        @if ($this->unreadCount > 0 || $totalCount > 0)
            <div style="padding:12px 16px;">

                <a href="/admin/kos-notifications"
                    style="display:block;text-align:center;font-size:13px;font-weight:600;color:#3b82f6;text-decoration:none;transition:color 0.15s;"
                    onmouseenter="this.style.color='#60a5fa';this.style.textDecoration='underline'"
                    onmouseleave="this.style.color='#3b82f6';this.style.textDecoration='none'">

                    Lihat semua notifikasi →

                </a>

            </div>
        @endif

    </div>

</div>
