<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stripe Menu</title>
    <!-- Styles -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:400,600">
    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/laracasts.css') }}">

</head>
<body>
    <div id="app" class="container mx-auto px-4 xl:px-48 my-8" v-cloak>
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellat, unde. Fuga odit eos aliquid obcaecati sunt facere fugiat in tempora, ipsam porro corporis nobis eum ad labore, voluptate distinctio officiis!
        Debitis obcaecati enim possimus voluptate quisquam, neque fugiat magnam doloremque animi perspiciatis reprehenderit, ipsam quaerat ullam et totam. Libero illum, esse voluptate itaque maiores reprehenderit tenetur tempore repellendus voluptatem quae!
        Suscipit nemo dolorem mollitia esse quam laudantium fugiat laboriosam? Ipsa porro dicta vel nisi. Est vero magnam saepe quasi beatae nobis, quam dolorem, molestias aut dicta officiis. Soluta, recusandae maiores!
        Voluptatibus amet excepturi incidunt pariatur nam esse porro quisquam? Numquam incidunt voluptates qui explicabo eum reiciendis id cumque cupiditate accusamus consectetur atque nemo esse iure quod ex expedita, voluptate officiis.

        <tab-group>
            <tab-list>
                <tab v-slot="{ selected }" as="template">
                    <button
                        class="font-semibold hover:bg-yellow-400 px-4 py-2 "
                        :class="[selected ? 'bg-yellow-500 text-white' : 'bg-white text-gray-900']">
                        Thrusday , August 19
                    </button>
                </tab>
                <tab>
                    <button class="font-semibold hover:bg-yellow-400 px-4 py-2 "
                        :class="[selected ? 'bg-yellow-500 text-white' : 'bg-white text-gray-900']">
                        Friday , August 20
                    </button>
                </tab>
                <tab>
                    <button class="font-semibold hover:bg-yellow-400 px-4 py-2 "
                        :class="[selected ? 'bg-yellow-500 text-white' : 'bg-white text-gray-900']">
                        Saturday , August 21
                    </button>
                </tab>
                <tab>
                    <button class="font-semibold hover:bg-yellow-400 px-4 py-2 "
                        :class="[selected ? 'bg-yellow-500 text-white' : 'bg-white text-gray-900']">
                        Sunday , August 22
                    </button>
                </tab>
            </tab-list>
            <tab-panels>
                <tab-panel>
                    <!-- Start of Tab Pannel-->
                    <div class="flex">
                        <div class="w-40 bg-gray-900 text-white text-sm divide-y divide-white border-r border-white">
                            <div class="h-10 ">&nbsp;</div>
                            <a class="h-16 px-4 py-2 flex justify-between hover:text-gray-200">
                                <span> Bethesda Global</span>
                                <div class="pt-1">
                                    <svg class="h-4 w-4" aria-hidden="true" focusable="false" data-prefix="fab" data-icon="twitch"
                                        role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                        <path data-v-07bee6f7="" fill="currentColor"
                                            d="M391.17,103.47H352.54v109.7h38.63ZM285,103H246.37V212.75H285ZM120.83,0,24.31,91.42V420.58H140.14V512l96.53-91.42h77.25L487.69,256V0ZM449.07,237.75l-77.22,73.12H294.61l-67.6,64v-64H140.14V36.58H449.07Z"
                                            class=""></path>
                                    </svg>
                                </div>
                            </a>
                            <a class="h-16 px-4 py-2 flex justify-between hover:text-gray-200">
                                <span>Bethesda Benelux</span>
                                <div class="pt-1">
                                    <svg class="h-4 w-4" aria-hidden="true" focusable="false" data-prefix="fab" data-icon="twitch"
                                        role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                        <path data-v-07bee6f7="" fill="currentColor"
                                            d="M391.17,103.47H352.54v109.7h38.63ZM285,103H246.37V212.75H285ZM120.83,0,24.31,91.42V420.58H140.14V512l96.53-91.42h77.25L487.69,256V0ZM449.07,237.75l-77.22,73.12H294.61l-67.6,64v-64H140.14V36.58H449.07Z"
                                            class=""></path>
                                    </svg>
                                </div>
                            </a>
                            <a class="h-16 px-4 py-2 flex justify-between hover:text-gray-200">
                                <span>Bethesda France</span>
                                <div class="pt-1">
                                    <svg class="h-4 w-4" aria-hidden="true" focusable="false" data-prefix="fab" data-icon="twitch"
                                        role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                        <path data-v-07bee6f7="" fill="currentColor"
                                            d="M391.17,103.47H352.54v109.7h38.63ZM285,103H246.37V212.75H285ZM120.83,0,24.31,91.42V420.58H140.14V512l96.53-91.42h77.25L487.69,256V0ZM449.07,237.75l-77.22,73.12H294.61l-67.6,64v-64H140.14V36.58H449.07Z"
                                            class=""></path>
                                    </svg>
                                </div>
                            </a>
                            <a class="h-16 px-4 py-2 flex justify-between hover:text-gray-200">
                                <span>Bethesda France</span>
                                <div class="pt-1">
                                    <svg class="h-4 w-4" aria-hidden="true" focusable="false" data-prefix="fab" data-icon="twitch"
                                        role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                        <path data-v-07bee6f7="" fill="currentColor"
                                            d="M391.17,103.47H352.54v109.7h38.63ZM285,103H246.37V212.75H285ZM120.83,0,24.31,91.42V420.58H140.14V512l96.53-91.42h77.25L487.69,256V0ZM449.07,237.75l-77.22,73.12H294.61l-67.6,64v-64H140.14V36.58H449.07Z"
                                            class=""></path>
                                    </svg>
                                </div>
                            </a>
                        </div>
                        <div class="w-full bg-gray-500 divide-y divide-white overflow-x-auto overflow-y-hidden">
                            <div class="h-10 w-table bg-gray-900 text-white text-sm flex divide-x divide-white">
                                <div class="w-32 flex justify-center items-center">8:00</div>
                                <div class="w-32 flex justify-center items-center">8:30</div>
                                <div class="w-32 flex justify-center items-center">9:00</div>
                                <div class="w-32 flex justify-center items-center">9:30</div>
                                <div class="w-32 flex justify-center items-center">10:00</div>
                                <div class="w-32 flex justify-center items-center">10:30</div>
                                <div class="w-32 flex justify-center items-center">11:00</div>
                                <div class="w-32 flex justify-center items-center">11:30</div>
                                <div class="w-32 flex justify-center items-center">12:00</div>
                                <div class="w-32 flex justify-center items-center">12:30</div>
                                <div class="w-32 flex justify-center items-center">13:00</div>
                                <div class="w-32 flex justify-center items-center">13:30</div>
                                <div class="w-32 flex justify-center items-center">14:00</div>
                                <div class="w-32 flex justify-center items-center">14:30</div>
                                <div class="w-32 flex justify-center items-center">15:00</div>
                                <div class="w-32 flex justify-center items-center">15:30</div>
                                <div class="w-32 flex justify-center items-center">16:00</div>
                                <div class="w-32 flex justify-center items-center">16:30</div>
                                <div class="w-32 flex justify-center items-center">17:00</div>
                                <div class="w-32 flex justify-center items-center">17:30</div>
                            </div>
                            <div class="h-16 w-table flex divide-x divide-white">
                                <event-slot title="Fallout 86 - UK Stream Team Build-a-thon"
                                    description="The UK Stream Team race against the clock to see whoca build the best C.A.M.P before the time runs outs."
                                    time="9:00 AM  - 10:30 AM EDT"
                                    watch-description="Watch on <a href='https://www.twitch.tv/bethesda' class='underline'>https://www.twitch.tv/bethesda</a>"
                                    width-class="w-64" color-class="bg-red-600" color-hover-class="hover:bg-red-700"
                                    border-color-class="border-red-700"></event-slot>
                                <event-slot-empty></event-slot-empty>
                                <event-slot-empty></event-slot-empty>

                                <event-slot title="Let's talk Quake"
                                    description="The UK Stream Team race against the clock to see whoca build the best C.A.M.P before the time runs outs."
                                    time="10:00 AM  - 10:30 AM EDT" watch-description="Let's talk Quake" width-class="w-64"
                                    color-class="bg-red-600" color-hover-class="hover:bg-red-700" border-color-class="border-red-700">
                                </event-slot>

                                <event-slot title="New Orleans Hurricane Ida"
                                    description="The UK Stream Team race against the clock to see whoca build the best C.A.M.P before the time runs outs."
                                    time="10:00 AM  - 10:30 AM EDT" watch-description="Let's talk Quake" width-class="w-64"
                                    color-class="bg-red-600" color-hover-class="hover:bg-red-700" border-color-class="border-red-700">
                                </event-slot>
                            </div>
                            <div class="h-16 w-table flex divide-x divide-white">
                                <event-slot-empty></event-slot-empty>
                                <event-slot title="Fallout 86 - UK Stream Team Build-a-thon"
                                    description="The UK Stream Team race against the clock to see whoca build the best C.A.M.P before the time runs outs."
                                    time="9:00 AM  - 10:30 AM EDT"
                                    watch-description="Watch on <a href='https://www.twitch.tv/bethesda' class='underline'>https://www.twitch.tv/bethesda</a>"
                                    width-class="w-64" color-class="bg-blue-600" color-hover-class="hover:bg-blue-700"
                                    border-color-class="border-blue-700"></event-slot>

                                <event-slot-empty></event-slot-empty>

                                <event-slot title="Let's talk Quake"
                                    description="The UK Stream Team race against the clock to see whoca build the best C.A.M.P before the time runs outs."
                                    time="10:00 AM  - 10:30 AM EDT" watch-description="Let's talk Quake" width-class="w-64"
                                    color-class="bg-blue-600" color-hover-class="hover:bg-blue-700" border-color-class="border-blue-700">
                                </event-slot>
                                <event-slot-empty></event-slot-empty>
                                <event-slot title="New Orleans Hurricane Ida"
                                    description="The UK Stream Team race against the clock to see whoca build the best C.A.M.P before the time runs outs."
                                    time="10:00 AM  - 10:30 AM EDT" watch-description="Let's talk Quake" width-class="w-64"
                                    color-class="bg-blue-600" color-hover-class="hover:bg-blue-700" border-color-class="border-blue-700">
                                </event-slot>
                            </div>
                            <div class="h-16 w-table flex divide-x divide-white">
                                <event-slot-empty></event-slot-empty>
                                <event-slot title="Fallout 86 - UK Stream Team Build-a-thon"
                                    description="The UK Stream Team race against the clock to see whoca build the best C.A.M.P before the time runs outs."
                                    time="9:00 AM  - 10:30 AM EDT"
                                    watch-description="Watch on <a href='https://www.twitch.tv/bethesda' class='underline'>https://www.twitch.tv/bethesda</a>"
                                    width-class="w-64" color-class="bg-green-600" color-hover-class="hover:bg-green-700"
                                    border-color-class="border-green-700"></event-slot>

                                <event-slot-empty></event-slot-empty>

                                <event-slot title="Let's talk Quake"
                                    description="The UK Stream Team race against the clock to see whoca build the best C.A.M.P before the time runs outs."
                                    time="10:00 AM  - 10:30 AM EDT" watch-description="Let's talk Quake" width-class="w-64"
                                    color-class="bg-green-600" color-hover-class="hover:bg-green-700" border-color-class="border-green-700">
                                </event-slot>
                                <event-slot-empty></event-slot-empty>
                                <event-slot title="New Orleans Hurricane Ida"
                                    description="The UK Stream Team race against the clock to see whoca build the best C.A.M.P before the time runs outs."
                                    time="10:00 AM  - 10:30 AM EDT" watch-description="Let's talk Quake" width-class="w-64"
                                    color-class="bg-green-600" color-hover-class="hover:bg-green-700" border-color-class="border-green-700">
                                </event-slot>
                            </div>
                            <div class="h-16 w-table flex divide-x divide-white">
                                <event-slot-empty></event-slot-empty>
                                <event-slot title="Fallout 86 - UK Stream Team Build-a-thon"
                                    description="The UK Stream Team race against the clock to see whoca build the best C.A.M.P before the time runs outs."
                                    time="9:00 AM  - 10:30 AM EDT"
                                    watch-description="Watch on <a href='https://www.twitch.tv/bethesda' class='underline'>https://www.twitch.tv/bethesda</a>"
                                    width-class="w-64" color-class="bg-indigo-600" color-hover-class="hover:bg-indigo-700"
                                    border-color-class="border-indigo-700 "></event-slot>

                                <event-slot-empty></event-slot-empty>

                                <event-slot title="Let's talk Quake"
                                    description="The UK Stream Team race against the clock to see whoca build the best C.A.M.P before the time runs outs."
                                    time="10:00 AM  - 10:30 AM EDT" watch-description="Let's talk Quake" width-class="w-64"
                                    color-class="bg-indigo-600" color-hover-class="hover:bg-indigo-700"
                                    border-color-class="border-indigo-700">
                                </event-slot>
                                <event-slot-empty></event-slot-empty>
                                <event-slot title="New Orleans Hurricane Ida"
                                    description="The UK Stream Team race against the clock to see whoca build the best C.A.M.P before the time runs outs."
                                    time="10:00 AM  - 10:30 AM EDT" watch-description="Let's talk Quake" width-class="w-64"
                                    color-class="bg-indigo-600" color-hover-class="hover:bg-indigo-700"
                                    border-color-class="border-indigo-700">
                                </event-slot>
                            </div>
                        </div>
                    </div><!-- End of Tab Pannel-->
                </tab-panel>
                <tab-panel>
                    <!-- Start of Tab Pannel-->
                    <div class="flex">
                        <div class="w-40 bg-gray-900 text-white text-sm divide-y divide-white border-r border-white">
                            <div class="h-10 ">&nbsp;</div>
                            <a class="h-16 px-4 py-2 flex justify-between hover:text-gray-200">
                                <span> Bethesda Global</span>
                                <div class="pt-1">
                                    <svg class="h-4 w-4" aria-hidden="true" focusable="false" data-prefix="fab" data-icon="twitch"
                                        role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                        <path data-v-07bee6f7="" fill="currentColor"
                                            d="M391.17,103.47H352.54v109.7h38.63ZM285,103H246.37V212.75H285ZM120.83,0,24.31,91.42V420.58H140.14V512l96.53-91.42h77.25L487.69,256V0ZM449.07,237.75l-77.22,73.12H294.61l-67.6,64v-64H140.14V36.58H449.07Z"
                                            class=""></path>
                                    </svg>
                                </div>
                            </a>
                            <a class="h-16 px-4 py-2 flex justify-between hover:text-gray-200">
                                <span>Bethesda Benelux</span>
                                <div class="pt-1">
                                    <svg class="h-4 w-4" aria-hidden="true" focusable="false" data-prefix="fab" data-icon="twitch"
                                        role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                        <path data-v-07bee6f7="" fill="currentColor"
                                            d="M391.17,103.47H352.54v109.7h38.63ZM285,103H246.37V212.75H285ZM120.83,0,24.31,91.42V420.58H140.14V512l96.53-91.42h77.25L487.69,256V0ZM449.07,237.75l-77.22,73.12H294.61l-67.6,64v-64H140.14V36.58H449.07Z"
                                            class=""></path>
                                    </svg>
                                </div>
                            </a>
                            <a class="h-16 px-4 py-2 flex justify-between hover:text-gray-200">
                                <span>Bethesda France</span>
                                <div class="pt-1">
                                    <svg class="h-4 w-4" aria-hidden="true" focusable="false" data-prefix="fab" data-icon="twitch"
                                        role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                        <path data-v-07bee6f7="" fill="currentColor"
                                            d="M391.17,103.47H352.54v109.7h38.63ZM285,103H246.37V212.75H285ZM120.83,0,24.31,91.42V420.58H140.14V512l96.53-91.42h77.25L487.69,256V0ZM449.07,237.75l-77.22,73.12H294.61l-67.6,64v-64H140.14V36.58H449.07Z"
                                            class=""></path>
                                    </svg>
                                </div>
                            </a>
                            <a class="h-16 px-4 py-2 flex justify-between hover:text-gray-200">
                                <span>Bethesda France</span>
                                <div class="pt-1">
                                    <svg class="h-4 w-4" aria-hidden="true" focusable="false" data-prefix="fab" data-icon="twitch"
                                        role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                        <path data-v-07bee6f7="" fill="currentColor"
                                            d="M391.17,103.47H352.54v109.7h38.63ZM285,103H246.37V212.75H285ZM120.83,0,24.31,91.42V420.58H140.14V512l96.53-91.42h77.25L487.69,256V0ZM449.07,237.75l-77.22,73.12H294.61l-67.6,64v-64H140.14V36.58H449.07Z"
                                            class=""></path>
                                    </svg>
                                </div>
                            </a>
                        </div>
                        <div class="w-full bg-gray-500 divide-y divide-white overflow-x-auto overflow-y-hidden">
                            <div class="h-10 w-table bg-gray-900 text-white text-sm flex divide-x divide-white">
                                <div class="w-32 flex justify-center items-center">8:00</div>
                                <div class="w-32 flex justify-center items-center">8:30</div>
                                <div class="w-32 flex justify-center items-center">9:00</div>
                                <div class="w-32 flex justify-center items-center">9:30</div>
                                <div class="w-32 flex justify-center items-center">10:00</div>
                                <div class="w-32 flex justify-center items-center">10:30</div>
                                <div class="w-32 flex justify-center items-center">11:00</div>
                                <div class="w-32 flex justify-center items-center">11:30</div>
                                <div class="w-32 flex justify-center items-center">12:00</div>
                                <div class="w-32 flex justify-center items-center">12:30</div>
                                <div class="w-32 flex justify-center items-center">13:00</div>
                                <div class="w-32 flex justify-center items-center">13:30</div>
                                <div class="w-32 flex justify-center items-center">14:00</div>
                                <div class="w-32 flex justify-center items-center">14:30</div>
                                <div class="w-32 flex justify-center items-center">15:00</div>
                                <div class="w-32 flex justify-center items-center">15:30</div>
                                <div class="w-32 flex justify-center items-center">16:00</div>
                                <div class="w-32 flex justify-center items-center">16:30</div>
                                <div class="w-32 flex justify-center items-center">17:00</div>
                                <div class="w-32 flex justify-center items-center">17:30</div>
                            </div>
                            <div class="h-16 w-table flex divide-x divide-white">
                                <event-slot title="Fallout 996 - UK Stream Team Build-a-thon"
                                    description="The UK Stream Team race against the clock to see whoca build the best C.A.M.P before the time runs outs."
                                    time="9:00 AM  - 10:30 AM EDT"
                                    watch-description="Watch on <a href='https://www.twitch.tv/bethesda' class='underline'>https://www.twitch.tv/bethesda</a>"
                                    width-class="w-64" color-class="bg-red-600" color-hover-class="hover:bg-red-700"
                                    border-color-class="border-red-700"></event-slot>
                                <event-slot-empty></event-slot-empty>
                                <event-slot-empty></event-slot-empty>

                                <event-slot title="Let's talk Quake"
                                    description="The UK Stream Team race against the clock to see whoca build the best C.A.M.P before the time runs outs."
                                    time="10:00 AM  - 10:30 AM EDT" watch-description="Let's talk Quake" width-class="w-64"
                                    color-class="bg-red-600" color-hover-class="hover:bg-red-700" border-color-class="border-red-700">
                                </event-slot>

                                <event-slot title="New Orleans Hurricane Ida"
                                    description="The UK Stream Team race against the clock to see whoca build the best C.A.M.P before the time runs outs."
                                    time="10:00 AM  - 10:30 AM EDT" watch-description="Let's talk Quake" width-class="w-64"
                                    color-class="bg-red-600" color-hover-class="hover:bg-red-700" border-color-class="border-red-700">
                                </event-slot>
                            </div>
                            <div class="h-16 w-table flex divide-x divide-white">
                                <event-slot-empty></event-slot-empty>
                                <event-slot title="Fallout 86 - UK Stream Team Build-a-thon"
                                    description="The UK Stream Team race against the clock to see whoca build the best C.A.M.P before the time runs outs."
                                    time="9:00 AM  - 10:30 AM EDT"
                                    watch-description="Watch on <a href='https://www.twitch.tv/bethesda' class='underline'>https://www.twitch.tv/bethesda</a>"
                                    width-class="w-64" color-class="bg-blue-600" color-hover-class="hover:bg-blue-700"
                                    border-color-class="border-blue-700"></event-slot>

                                <event-slot-empty></event-slot-empty>

                                <event-slot title="Let's talk Quake"
                                    description="The UK Stream Team race against the clock to see whoca build the best C.A.M.P before the time runs outs."
                                    time="10:00 AM  - 10:30 AM EDT" watch-description="Let's talk Quake" width-class="w-64"
                                    color-class="bg-blue-600" color-hover-class="hover:bg-blue-700" border-color-class="border-blue-700">
                                </event-slot>
                                <event-slot-empty></event-slot-empty>
                                <event-slot title="New Orleans Hurricane Ida"
                                    description="The UK Stream Team race against the clock to see whoca build the best C.A.M.P before the time runs outs."
                                    time="10:00 AM  - 10:30 AM EDT" watch-description="Let's talk Quake" width-class="w-64"
                                    color-class="bg-blue-600" color-hover-class="hover:bg-blue-700" border-color-class="border-blue-700">
                                </event-slot>
                            </div>
                            <div class="h-16 w-table flex divide-x divide-white">
                                <event-slot-empty></event-slot-empty>
                                <event-slot title="Fallout 86 - UK Stream Team Build-a-thon"
                                    description="The UK Stream Team race against the clock to see whoca build the best C.A.M.P before the time runs outs."
                                    time="9:00 AM  - 10:30 AM EDT"
                                    watch-description="Watch on <a href='https://www.twitch.tv/bethesda' class='underline'>https://www.twitch.tv/bethesda</a>"
                                    width-class="w-64" color-class="bg-green-600" color-hover-class="hover:bg-green-700"
                                    border-color-class="border-green-700"></event-slot>

                                <event-slot-empty></event-slot-empty>

                                <event-slot title="Let's talk Quake"
                                    description="The UK Stream Team race against the clock to see whoca build the best C.A.M.P before the time runs outs."
                                    time="10:00 AM  - 10:30 AM EDT" watch-description="Let's talk Quake" width-class="w-64"
                                    color-class="bg-green-600" color-hover-class="hover:bg-green-700" border-color-class="border-green-700">
                                </event-slot>
                                <event-slot-empty></event-slot-empty>
                                <event-slot title="New Orleans Hurricane Ida"
                                    description="The UK Stream Team race against the clock to see whoca build the best C.A.M.P before the time runs outs."
                                    time="10:00 AM  - 10:30 AM EDT" watch-description="Let's talk Quake" width-class="w-64"
                                    color-class="bg-green-600" color-hover-class="hover:bg-green-700" border-color-class="border-green-700">
                                </event-slot>
                            </div>
                            <div class="h-16 w-table flex divide-x divide-white">
                                <event-slot-empty></event-slot-empty>
                                <event-slot title="Fallout 86 - UK Stream Team Build-a-thon"
                                    description="The UK Stream Team race against the clock to see whoca build the best C.A.M.P before the time runs outs."
                                    time="9:00 AM  - 10:30 AM EDT"
                                    watch-description="Watch on <a href='https://www.twitch.tv/bethesda' class='underline'>https://www.twitch.tv/bethesda</a>"
                                    width-class="w-64" color-class="bg-indigo-600" color-hover-class="hover:bg-indigo-700"
                                    border-color-class="border-indigo-700 "></event-slot>

                                <event-slot-empty></event-slot-empty>

                                <event-slot title="Let's talk Quake"
                                    description="The UK Stream Team race against the clock to see whoca build the best C.A.M.P before the time runs outs."
                                    time="10:00 AM  - 10:30 AM EDT" watch-description="Let's talk Quake" width-class="w-64"
                                    color-class="bg-indigo-600" color-hover-class="hover:bg-indigo-700"
                                    border-color-class="border-indigo-700">
                                </event-slot>
                                <event-slot-empty></event-slot-empty>
                                <event-slot title="New Orleans Hurricane Ida"
                                    description="The UK Stream Team race against the clock to see whoca build the best C.A.M.P before the time runs outs."
                                    time="10:00 AM  - 10:30 AM EDT" watch-description="Let's talk Quake" width-class="w-64"
                                    color-class="bg-indigo-600" color-hover-class="hover:bg-indigo-700"
                                    border-color-class="border-indigo-700">
                                </event-slot>
                            </div>
                        </div>
                    </div><!-- End of Tab Pannel-->
                </tab-panel>
                <tab-panel>Content 3</tab-panel>
            </tab-panels>
        </tab-group>

    </div>
<script src="{{ mix('js/laracasts.js') }}"></script>
</body>
</html>
