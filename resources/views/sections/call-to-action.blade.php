<section class="py-[90px]">
    <div class="mx-auto max-w-[1440px] lg:grid lg:grid-cols-12 relative">
        <div
            class="pr-6 pb-24 pt-10 sm:pb-32 lg:col-span-7 lg:pr-[70px] lg:py-[93px] xl:col-span-6 flex flex-col justify-center">
            <div class="mx-auto max-w-2xl lg:mx-0">
                <h2 class="font-bold text-[36px] leading-[48px]">
                    {{__('app.home.call_to_action.title')}}
                </h2>
                <div class="mt-5 flex items-center gap-x-6">
                    <x-button theme="gradient" href="{{route('celebrity.index')}}">
                        {{__('app.home.call_to_action.button_text')}}
                    </x-button>
                </div>
            </div>
        </div>
        <div class="relative lg:col-span-5 lg:-mr-8  xl:mr-0 lg:pr-8">
            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="708"
                 height="543.301" viewBox="0 0 708 543.301">
                <defs>
                    <linearGradient id="linear-gradient" x1="0.22" y1="0.76" x2="0.819" y2="-0.021"
                                    gradientUnits="objectBoundingBox">
                        <stop offset="0" stop-color="#fe3448"/>
                        <stop offset="1" stop-color="#e82399"/>
                    </linearGradient>
                </defs>
                <path id="sigle"
                      d="M1183.8,456.416C1183.8,328.808,1063.847,225,916.4,225c-112.556,0-209.051,60.549-248.432,145.905q11.327-1.076,23.03-1.093a245.67,245.67,0,0,1,35.366,2.529c36.22-56.585,107.823-95.2,190.019-95.2,118.672,0,215.2,80.385,215.2,179.221s-96.547,179.221-215.2,179.221-215.2-80.385-215.2-179.221a152.481,152.481,0,0,1,1.384-19.836c90.14,4.972,161.641,67.571,161.641,143.906a123.086,123.086,0,0,1-2.956,26.533,260.459,260.459,0,0,0,41.909,4.63,163.07,163.07,0,0,0,3.058-31.112c0-102.7-96.547-186.243-215.2-186.243S475.8,477.772,475.8,580.486c0,44.882,18.452,86.074,49.085,118.245L506.348,768.3,567.29,732.7c35.024,21.408,77.7,34.033,123.729,34.033,74.319,0,139.891-32.786,178.606-82.537a307.4,307.4,0,0,0,46.83,3.639c57.2,0,110.215-15.684,153.747-42.251l75.7,44.216-23.031-86.45C1160.906,563.316,1183.8,512.129,1183.8,456.416ZM691.019,724.666c-95.539,0-173.207-64.718-173.207-144.231,0-67.673,56.295-124.6,131.947-140.079-.427,5.313-.718,10.61-.718,16.009,0,99.263,72.645,184.141,174.352,216.927C791.513,704.694,744.068,724.666,691.019,724.666Z"
                      transform="translate(-475.8 -225)" fill="url(#linear-gradient)"/>
            </svg>
        </div>
    </div>
</section>
