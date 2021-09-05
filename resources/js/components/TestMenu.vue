<template>
    <div class="container mx-auto px-2">
        <h2 class="font-bold text-xl pt-2">Menu (Dropdown)</h2>

        <!--Start of the Menu-->
        <div class="mt-4">
        <Menu>
            <MenuButton class="flex items-center bg-blue-500 text-white rounded-md px-4 py-2">
                <span>Option</span>
                <ChevronDownIcon class="h-5 w-5 ml-2" />
                <!-- <svg xmlns="http://www.w3.org/2000/svg" class="ml-2 h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                 <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg> -->
            </MenuButton>
            <transition
                enter-active-class="transition duration-200 ease-out"
                enter-from-class="transform scale-75 opacity-0"
                enter-to-class="transform scale-100 opacity-100"
                leave-active-class="transition duration-75 ease-out"
                leave-from-class="transform scale-100 opacity-100"
                leave-to-class="transform scale-75 opacity-0"
            >
                <MenuItems class="absolute bg-white shadow-md rounded-lg flex flex-col focus:outline-none mt-2 w-56 divide-y divide-gray-200 origin-top-left">
                    <div class="px-1 py-1">
                        <MenuItem class="mt-2" v-slot="{ active }">
                        <button
                            class="w-full flex items-center rounded-md px-2 py-2 font-semibold"
                            :class='{ "bg-blue-500 text-white": active }'
                        >
                            <span><PencilIcon class="h-4 w-4 "/></span>
                            <span class="ml-2"> Edit</span>
                        </button>
                        </MenuItem>
                        <MenuItem class="mt-2" v-slot="{ active }">
                            <button
                                class="w-full flex items-center rounded-md px-2 py-2 font-semibold"
                                :class='{ "bg-blue-500 text-white": active }'
                            >
                                <span><DuplicateIcon class="h-4 w-4 "/></span>
                                <span class="ml-2"> Duplicate</span>
                            </button>
                        </MenuItem>
                    </div>
                    <div class="px-1 py-1">
                        <MenuItem class="mt-2" v-slot="{ active }">
                            <button
                                class="w-full flex items-center rounded-md px-2 py-2 font-semibold"
                                :class='{ "bg-blue-500 text-white": active }'
                            >
                                <span><ArchiveIcon class="h-4 w-4 "/></span>
                                <span class="ml-2"> Archieve</span>
                            </button>
                        </MenuItem>
                        <MenuItem class="mt-2" v-slot="{ active }">
                            <button
                                class="w-full flex items-center rounded-md px-2 py-2 font-semibold"
                                :class='{ "bg-blue-500 text-white": active }'
                            >
                                <span><HandIcon class="h-4 w-4 "/></span>
                                <span class="ml-2"> Move</span>
                            </button>
                        </MenuItem>
                    </div>
                    <div class="py-1 px-1">

                        <MenuItem class="mt-2" v-slot="{ active }">
                            <button
                                class="w-full flex items-center rounded-md px-2 py-2 font-semibold"
                                :class='{ "bg-blue-500 text-white": active }'
                            >
                                <span><TrashIcon class="h-4 w-4 "/></span>
                                <span class="ml-2"> Delete</span>
                            </button>
                        </MenuItem>
                        <MenuItem class="mt-2" v-slot="{ active,disabled }" disabled>
                            <button
                                class="w-full flex items-center rounded-md px-2 py-2 font-semibold"
                                :class='{
                                    "bg-blue-500 text-white": active,
                                    "opacity-50 cursor-not-allowed":disabled
                                }'
                            >
                                <span><TrashIcon class="h-4 w-4 "/></span>
                                <span class="ml-2"> Delete</span>
                            </button>
                        </MenuItem>
                    </div>
                </MenuItems>
            </transition>
        </Menu>
        </div>
        <div>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sit dolorem esse doloremque tempora porro minima optio? Accusantium voluptates hic consequuntur aspernatur, necessitatibus aperiam odit maiores quae tempora velit! Nam, esse.
        Est porro cumque facilis nisi voluptates et voluptate, repudiandae corrupti veniam, vero sunt quas laboriosam omnis in minima neque laborum fugiat velit eveniet rerum. Aut voluptates cumque repellendus a minus.
        Blanditiis cum in, consequuntur hic fuga vero modi molestiae animi unde cupiditate voluptatem sit eaque enim. Minima porro commodi iure veritatis, maiores hic, id consequuntur aperiam impedit excepturi libero aliquam?</div>
        <!--End of the menu-->

    </div>
</template>

<script>
    import { Menu, MenuButton, MenuItems, MenuItem} from '@headlessui/vue'
    import { ChevronDownIcon } from '@heroicons/vue/solid'
    import { PencilIcon,DuplicateIcon, TrashIcon,ArchiveIcon,HandIcon} from '@heroicons/vue/outline'

    export default {

        components: {
            PencilIcon,
            ChevronDownIcon,
            DuplicateIcon,
            TrashIcon,
            ArchiveIcon,
            HandIcon,
            Menu,
            MenuButton,
            MenuItems,
            MenuItem
        },

        mounted() {
            console.log("Example component mounted");
        }
    }
</script>

<style lang="scss" scoped>

</style>