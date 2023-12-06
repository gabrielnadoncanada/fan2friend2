<div wire:poll="checkMeetingTime" class="h-screen flex">
    <script src='https://localhost:8443/external_api.js'></script>


    @if($isTimeCollapsed)
        <div class="bg-black" >
            <div x-data="{ open: true }" @keydown.window.escape="open = false"
                 x-init="$watch(&quot;open&quot;, o => !o &amp;&amp; window.setTimeout(() => (open = true), 1000))"
                 x-show="open" class="relative z-10" aria-labelledby="modal-title" x-ref="dialog" aria-modal="true">
                <div x-show="open" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
                     x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
                     x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                     x-description="Background backdrop, show/hide based on modal state."
                     class="fixed inset-0 bg-black bg-opacity-[90] transition-opacity"></div>
                <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
                    <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                        <div x-show="open" x-transition:enter="ease-out duration-300"
                             x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                             x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                             x-transition:leave="ease-in duration-200"
                             x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                             x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                             x-description="Modal panel, show/hide based on modal state."
                             class="relative transform overflow-hidden rounded-lg bg-white px-4 pb-4 pt-5 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-sm sm:p-6"
                             @click.away="open = false">
                            <div>
                                <div class="flex justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="250" height="43" viewBox="0 0 250 43">
                                        <defs>
                                            <linearGradient id="linear-gradient" x1="0.22" y1="0.24" x2="0.819" y2="1.021" gradientUnits="objectBoundingBox">
                                                <stop offset="0" stop-color="#fe3448"></stop>
                                                <stop offset="1" stop-color="#e82399"></stop>
                                            </linearGradient>
                                        </defs>
                                        <g id="logo-main" transform="translate(-348.45 -326.66)">
                                            <g id="Group_1" data-name="Group 1" transform="translate(421.597 337.766)">
                                                <path id="Path_1" data-name="Path 1" d="M540.384,368.5h5.793l-.279,2.811h-5.514v6.71H537.6V357.62h10.052l.279,2.757h-7.543V368.5Z" transform="translate(-537.6 -357.256)" fill="#0d0d0d"></path>
                                                <path id="Path_2" data-name="Path 2" d="M588.314,377.45h-3.09l-1.255-3.063h-7.88l-1.255,3.063h-3l8.267-20.77Zm-5.375-5.739-2.924-7.435-2.9,7.435Z" transform="translate(-558.576 -356.68)" fill="#0d0d0d"></path>
                                                <path id="Path_3" data-name="Path 3" d="M631.021,364.9v12.724H628.21V356.97l11.667,13.223V357.218h2.811v20.8Z" transform="translate(-593.124 -356.858)" fill="#0d0d0d"></path>
                                                <path id="Path_4" data-name="Path 4" d="M693.925,375.483l-.279,2.451H681.84c3.841-5.344,5.928-8.3,7.21-9.967a8.714,8.714,0,0,0,1.781-4.592c-.054-1.309-.891-3.256-2.923-3.256a3.247,3.247,0,0,0-3.036,3.369,2.1,2.1,0,0,0,1.282,1.808v2.532a4.345,4.345,0,0,1-4.174-4.4,6.034,6.034,0,0,1,5.932-5.959,5.857,5.857,0,0,1,5.735,5.986c0,1.754-.5,3.508-2.172,6.068l-4.066,5.959h6.517Z" transform="translate(-625.988 -357.164)" fill="#0d0d0d"></path>
                                                <path id="Path_5" data-name="Path 5" d="M732.014,368.5h5.793l-.279,2.811h-5.514v6.71H729.23V357.62h10.052l.279,2.757h-7.543V368.5Z" transform="translate(-655.028 -357.256)" fill="#0d0d0d"></path>
                                                <path id="Path_6" data-name="Path 6" d="M782.5,378.026l-2.9-6.9a5.6,5.6,0,0,1-.7.054h-3.593v6.85H772.5V357.62h6.346a6.861,6.861,0,0,1,6.765,6.765,6.932,6.932,0,0,1-3.175,5.735l3.2,7.907H782.5Zm-3.617-9.44a4.2,4.2,0,0,0,0-8.379h-3.562v8.379Z" transform="translate(-681.543 -357.256)" fill="#0d0d0d"></path>
                                                <path id="Path_7" data-name="Path 7" d="M826.661,378.026H823.85V357.62h2.811Z" transform="translate(-713.01 -357.256)" fill="#0d0d0d"></path>
                                                <path id="Path_8" data-name="Path 8" d="M852.755,375.3H860.3l-.279,2.73H849.94V357.62h10.079l.279,2.757h-7.543v8.132h6.432l-.279,2.811h-6.153Z" transform="translate(-728.997 -357.256)" fill="#0d0d0d"></path>
                                                <path id="Path_9" data-name="Path 9" d="M896.841,364.9v12.724H894.03V356.97L905.7,370.193V357.218h2.811v20.8Z" transform="translate(-756.015 -356.858)" fill="#0d0d0d"></path>
                                                <path id="Path_10" data-name="Path 10" d="M957.095,357.61a10.205,10.205,0,1,1,0,20.41H950.33V357.614h6.765ZM955.728,375.4c4.511,0,8.631-2.532,8.631-7.574,0-4.345-3.09-7.574-8.631-7.574h-2.59V375.4h2.59Z" transform="translate(-790.515 -357.25)" fill="#0d0d0d"></path>
                                            </g>
                                            <path id="Path_11" data-name="Path 11" d="M405.812,344.975c0-10.1-9.719-18.315-21.665-18.315-9.119,0-16.937,4.792-20.127,11.548.612-.057,1.235-.087,1.866-.087a20.391,20.391,0,0,1,2.865.2c2.935-4.479,8.736-7.535,15.4-7.535,9.615,0,17.436,6.362,17.436,14.185s-7.822,14.185-17.436,14.185-17.436-6.362-17.436-14.185a11.706,11.706,0,0,1,.112-1.57c7.3.393,13.1,5.349,13.1,11.389a9.439,9.439,0,0,1-.24,2.1,21.63,21.63,0,0,0,3.4.367,12.653,12.653,0,0,0,.248-2.462c0-8.129-7.822-14.741-17.436-14.741s-17.436,6.612-17.436,14.741a13.371,13.371,0,0,0,3.977,9.358l-1.5,5.507,4.937-2.818a19.564,19.564,0,0,0,10.025,2.693A18.452,18.452,0,0,0,380.357,363a25.47,25.47,0,0,0,3.795.288,24.332,24.332,0,0,0,12.457-3.344l6.134,3.5-1.866-6.843A16.628,16.628,0,0,0,405.812,344.975Zm-39.926,21.231c-7.74,0-14.033-5.122-14.033-11.416,0-5.356,4.561-9.861,10.691-11.087-.035.42-.058.84-.058,1.267,0,7.856,5.886,14.574,14.126,17.169A15.479,15.479,0,0,1,365.886,366.207Z" fill="url(#linear-gradient)"></path>
                                        </g>
                                    </svg>
                                </div>
                                <div class="mt-3 text-center sm:mt-5">
                                    <h3 class="text-base font-semibold leading-6 text-gray-900" id="modal-title">
                                        Conférence terminée</h3>

                                </div>
                            </div>
                            <div class="mt-5 sm:mt-6 text-center">
                                <a type="button"
                                        class="btn gradient-to-98 text-white"
                                        href="{{route('home')}}">Retourner au site-web
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div wire:ignore id="meet" style="flex: 1;"></div>
        <script>
            document.addEventListener('readystatechange', (args) => {
                initializeJitsi(@json($meetingUrl))
                    .then(api => {
                        console.log('Jitsi Meet API initialized:', api);

                        // Perform further actions with the Jitsi Meet API
                    })
                    .catch(error => {
                        console.error('Failed to initialize Jitsi Meet API:', error);
                    });
            });

            function initializeJitsi(meetingUrl) {
                return new Promise((resolve, reject) => {
                    if (!meetingUrl) {
                        reject('Meeting URL is not provided');
                        return;
                    }

                    const url = new URL(meetingUrl);
                    const roomName = url.pathname.substring(1); // Extract room name from URL
                    const jwtToken = url.searchParams.get('jwt'); // Extract JWT token

                    const domain = 'localhost:8443';
                    const options = {
                        roomName: roomName,

                        parentNode: document.querySelector('#meet'),
                        configOverwrite: {disableDeepLinking: true},
                        userInfo: {displayName: 'User'},
                        jwt: jwtToken, // Pass the JWT token here
                        // ... other options ...
                    };

                    if (window.jitsiAPI) {
                        window.jitsiAPI.dispose();
                    }

                    try {
                        window.jitsiAPI = new JitsiMeetExternalAPI(domain, options);
                        resolve(window.jitsiAPI);
                    } catch (error) {
                        reject(error);
                    }
                });


            }

        </script>
    @endif
</div>
