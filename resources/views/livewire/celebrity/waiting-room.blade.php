<div class="pt-[85px]">
    <x-breadcrumbs
        :breadcrumbs="[
       ['route' => 'home', 'label' => 'Fan2Friend'],// Last breadcrumb without a link
    ['label' => 'Salle d\'attente'] // Last breadcrumb without a link

]">
    </x-breadcrumbs>


    <section class="max-w-[1440px] mx-auto grid grid-cols-12 mb-[35px]">
        <h1 class="h1 col-span-12">{{__('Salle d\'attente pour')}} <span
                class="text-gradient">{{$celebrity->full_name}}</span></h1>
    </section>

    <section class="max-w-[1440px] mx-auto grid grid-cols-12  pb-[70px] border-b border-[#D6D6D6]">

        <div class="col-span-7 pr-[70px]">
            <div>
                <div wire:poll.4s="setWaitingRoomPosition">
                    <h2 class="text-[30px] font-bold ">Il y a présentement <span
                            class="align-middle px-1 text-[50px] font-extrabold	 text-gradient">{{ $currentPosition }}</span>personnes
                        devant vous!</h2>

                    <div class="flex items-center gap-x-3 pt-[35px] pb-[50px]">
                        <p>
                            Lorsque ce sera votre tour, vous pourrez vous connecter en cliquant ici:
                        </p>

                        <a
                            @class([
                            'btn text-white',
                            'disabled gradient-gray opacity-70' => $currentPosition !== 0,
                            'gradient-to-98' => $currentPosition === 0,
                            ])
                            wire:click="{{$currentPosition === 0 ? 'joinMeeting' : ''}}"
                        >Rejoindre la rencontre</a>
                    </div>
                </div>

                <h3 class="text-[21px] font-bold leading-loose">
                    Rencontrer votre personnalité préférée, c'est excitant!
                </h3>
                <p>
                    Voici quelques conseils pour profiter au maximum de votre échange:
                </p>

                <div class="grid grid-cols-3 mb-[60px] mt-[35px] gap-[24px]">
                    <div>
                        <svg class="mb-2" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                             width="75" height="60" viewBox="0 0 75 60">
                            <defs>
                                <linearGradient id="linear-gradient" x2="1" y2="1" gradientUnits="objectBoundingBox">
                                    <stop offset="0" stop-color="#fe3448"/>
                                    <stop offset="1" stop-color="#e82399"/>
                                </linearGradient>
                            </defs>
                            <path id="preparez-questions"
                                  d="M16.875-10.312,11.25-7.5V-15H0V-52.5H48.75V-15H26.25Zm0-6.293,6.855-3.434,1.184-.6H43.125V-46.875H5.625v26.25h11.25ZM30-11.25h5.625v5.625H50.074l1.184.6,6.867,3.422v-4.02h11.25v-26.25H52.5V-37.5H75V0H63.75V7.5L58.125,4.688,48.75,0H30V-11.25ZM17.191-39.727a4.531,4.531,0,0,1,4.535-4.535h4.723a5.119,5.119,0,0,1,5.121,5.121A5.115,5.115,0,0,1,28.992-34.7L26.25-33.117v2.566H22.5V-35.3l.938-.539,3.68-2.109a1.393,1.393,0,0,0,.691-1.2,1.373,1.373,0,0,0-1.371-1.371H21.715a.785.785,0,0,0-.785.785v.539H17.18v-.539Zm5.191,12.621h3.984v3.984H22.383Z"
                                  transform="translate(0 52.5)" fill="url(#linear-gradient)"/>
                        </svg>

                        <h4 class="text-[18px] font-bold leading-loose">Préparez vos questions</h4>
                        <p class="text-[12px] leading-[15px]">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec rutrum blandit auctor.
                            Aliquam quis tellus id felis vehicula aliquam. Fusce venenatis ligula ipsum, ut ornare urna
                            molestie imperdiet.
                        </p>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="41.25"
                             height="60" viewBox="0 0 41.25 60">
                            <defs>
                                <linearGradient id="linear-gradient" x2="1" y2="1" gradientUnits="objectBoundingBox">
                                    <stop offset="0" stop-color="#fe3448"/>
                                    <stop offset="1" stop-color="#e82399"/>
                                </linearGradient>
                            </defs>
                            <path id="parlez-clairement"
                                  d="M16.875-46.875h11.25V-22.5A5.626,5.626,0,0,1,22.5-16.875,5.626,5.626,0,0,1,16.875-22.5ZM11.25-52.5v30A11.253,11.253,0,0,0,22.5-11.25,11.253,11.253,0,0,0,33.75-22.5v-30H11.25ZM7.5-27.187V-30H1.875v7.5A20.633,20.633,0,0,0,19.688-2.063V1.875H11.25V7.5h22.5V1.875H25.313V-2.063A20.633,20.633,0,0,0,43.125-22.5V-30H37.5v7.5a15,15,0,0,1-15,15,15,15,0,0,1-15-15Z"
                                  transform="translate(-1.875 52.5)" fill="url(#linear-gradient)"/>
                        </svg>


                        <h4 class="text-[18px] font-bold leading-loose">Parlez clairement</h4>
                        <p class="text-[12px] leading-[15px]">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec rutrum blandit auctor.
                            Aliquam quis tellus id felis vehicula aliquam. Fusce venenatis ligula ipsum, ut ornare urna
                            molestie imperdiet.
                        </p>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="75"
                             height="60" viewBox="0 0 75 48.293">
                            <defs>
                                <linearGradient id="linear-gradient" x2="1" y2="1" gradientUnits="objectBoundingBox">
                                    <stop offset="0" stop-color="#fe3448"/>
                                    <stop offset="1" stop-color="#e82399"/>
                                </linearGradient>
                            </defs>
                            <path id="soyez-courtois"
                                  d="M31.969-45l-5.625,5.625H24.551l-7.172,6.738-.809.762H11.25v15h3.609l.82.82,6.094,6.094.82.82,1.992,1.992,2.5,2.5,2.742-2.73,1.992-1.992,1.992,1.992L36.27-4.922l3.5-3.516,1.992-1.992,1.992,1.992L44.895-7.3l5.742-5.742v-.211L39.855-24.023,31.9-16.687l-2.109,1.945-1.9-2.145-7.5-8.437-1.816-2.039,1.992-1.875,15.937-15L37.313-45H50.754l.8.715L59.191-37.5H75v30H63.75V-9.375H54.9L46.863-1.336,44.871.656,42.879-1.336,41.742-2.473l-3.5,3.5L36.246,3.023,34.254,1.031,31.793-1.43,29.063,1.3,27.07,3.293,25.078,1.3,20.625-3.164,18.633-5.156l-.82-.82L12.539-11.25H11.25V-7.5H0v-30H14.332L21.5-44.238,22.313-45h9.656ZM63.75-15V-31.875H57.059l-.8-.715-7.641-6.785h-9.07L26.414-27.012,30.2-22.758l10.078-9.3,2.063-1.91,3.82,4.137L44.1-27.926,44-27.832,56.7-15.141l.141.141ZM7.5-13.125A1.875,1.875,0,0,0,5.625-15,1.875,1.875,0,0,0,3.75-13.125,1.875,1.875,0,0,0,5.625-11.25,1.875,1.875,0,0,0,7.5-13.125ZM69.375-11.25a1.875,1.875,0,0,0,1.875-1.875A1.875,1.875,0,0,0,69.375-15,1.875,1.875,0,0,0,67.5-13.125,1.875,1.875,0,0,0,69.375-11.25Z"
                                  transform="translate(0 45)" fill="url(#linear-gradient)"/>
                        </svg>


                        <h4 class="text-[18px] font-bold leading-loose">Soyez courtois</h4>
                        <p class="text-[12px] leading-[15px]">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec rutrum blandit auctor.
                            Aliquam quis tellus id felis vehicula aliquam. Fusce venenatis ligula ipsum, ut ornare urna
                            molestie imperdiet.
                        </p>
                    </div>
                </div>
            </div>

        </div>
        <div class="col-span-5 h-[390px] overflow-hidden">
            <video id="video" src="/374661739_682603526669086_1275610842352472967_n.mp4" controls autoplay loop muted>
                Your browser does not support the video tag.
            </video>
        </div>
        <div class="col-span-12 gradient-to-98 h-[450px] relative">
            {{--            <img src="/1682693920509.jpeg" alt="" class="w-full h-full absolute left-0 top-0 object-cover">--}}
        </div>

        <script>
            setTimeout(function () {
                document.getElementById('video').play();
            }, 2000);

        </script>
    </section>
</div>

