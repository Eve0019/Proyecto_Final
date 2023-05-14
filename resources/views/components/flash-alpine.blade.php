<div
	x-data="{flash: false, style: 'success', message: ''}"
	class="fixed top-0 left-0 z-[100] w-screen bg-opacity-60 backdrop-blur"
	:class="{ 'bg-indigo-500': style == 'success', 'bg-red-700': style == 'danger', 'bg-tertiary': style != 'success' && style != 'danger' }"
	style="display: none;"
	@flash-massage.window="
	flash = true;
	message = $event.detail.message
	style = $event.detail.style ?? 'success'
	"
	x-show="flash">
	<div class="mx-auto py-2 px-2 sm:px-6 lg:px-8">
		<div class="flex items-center justify-between flex-wrap">
			<div class="w-0 flex-1 flex items-center min-w-0">
                <span class="flex p-2 rounded-lg" :class="{ 'bg-indigo-600': style == 'success', 'bg-red-600': style == 'danger' }">
                    <svg x-show="style == 'success'" class="h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <svg x-show="style == 'danger'" class="h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <svg x-show="style != 'success' && style != 'danger'" class="p-1 h-8 w-8 rounded-lg text-white bg-tertiary" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </span>
				
				<p class="ml-3 font-medium text-sm text-white truncate" x-text="message"></p>
			</div>
			
			<div class="shrink-0 sm:ml-3">
				<button
					type="button"
					class="-mr-1 flex p-2 rounded-md focus:outline-none sm:-mr-2 transition"
					:class="{ 'hover:bg-indigo-600 focus:bg-indigo-600': style == 'success', 'hover:bg-red-600 focus:bg-red-600': style == 'danger' }"
					aria-label="Dismiss"
					x-on:click="flash = false">
					<svg class="h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
					</svg>
				</button>
			</div>
		</div>
	</div>
</div>