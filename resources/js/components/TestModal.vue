<template>
    <div class="container mx-auto px-2">
        <h2 class="font-bold text-2xl pt-2">Dialog(Modal)</h2>

        <!--Start of the Menu-->
        <div class="mt-4">
            <button
                class="w-32 flex items-center bg-blue-500 hover:bg-blue-400 text-white rounded-md px-2 py-2 font-semibold"
                @click="openModal">

                <span class="ml-2"> Open Modal</span>
            </button>
            <TransitionRoot appear :show="isOpen" as="template">
                <Dialog as="div" @close="closeModal">
                    <div class="fixed inset-0 z-10 overflow-y-auto">
                        <div class="min-h-screen px-4 text-center">
                            <TransitionChild
                                as="template"
                                enter="duration-300 ease-out"
                                enter-from="opacity-0"
                                enter-to="opacity-100"
                                leave="duration-200 ease-in"
                                leave-from="opacity-100"
                                leave-to="opacity-0"
                            >
                                <DialogOverlay class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" />
                            </TransitionChild>

                            <span class="inline-block h-screen align-middle" aria-hidden="true">
                                &#8203;
                            </span>

                            <TransitionChild
                                as="template"
                                enter="duration-300 ease-out"
                                enter-from="opacity-0 scale-95 rotate-180"
                                enter-to="opacity-100 scale-100 rotate-0"
                                leave="duration-200 ease-in"
                                leave-from="opacity-100 scale-100"
                                leave-to="opacity-0 scale-95"
                            >
                                <div
                                    class="inline-block w-full max-w-md p-6 my-8 overflow-hidden text-left align-middle transition-all transform bg-white shadow-xl rounded-2xl"
                                >
                                    <button class="absolute top-3 right-3 "  @click="closeModal">
                                        <XIcon class="h-4 w-4 text-gray-500 hover:text-gray-800"/>
                                    </button>
                                    <DialogTitle
                                        as="h3"
                                        class="text-lg font-medium leading-6 text-gray-900"
                                    >
                                        Payment successful
                                    </DialogTitle>
                                    <div class="mt-2">
                                        <p class="text-sm text-gray-500">
                                            Your payment has been successfully submitted. We’ve sent your
                                            an email with all of the details of your order.
                                        </p>
                                    </div>

                                    <div class="mt-4">
                                        <button type="button"
                                            class="inline-flex justify-center px-4 py-2 text-sm font-medium text-blue-900 bg-blue-100 border border-transparent rounded-md hover:bg-blue-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 focus-visible:ring-blue-500"
                                            @click="closeModal">
                                            Got it, thanks!
                                        </button>
                                    </div>
                                </div>
                            </TransitionChild>
                        </div>
                    </div>
                </Dialog>
            </TransitionRoot>
        </div>
    </div>
</template>

<script>
     import { ref } from 'vue'
    import {
        ChevronDownIcon,
        HandIcon,
        XIcon
    } from '@heroicons/vue/solid'
    import {
        TransitionRoot,
        TransitionChild,
        Dialog,
        DialogOverlay,
        DialogTitle,
    } from '@headlessui/vue'

    export default {
        components: {
            ChevronDownIcon,
            HandIcon,
            XIcon,
            TransitionRoot,
            TransitionChild,
            Dialog,
            DialogOverlay,
            DialogTitle,
        },
        setup() {
            const isOpen = ref(false)

            return {
                isOpen,
                closeModal() {
                    isOpen.value = false
                },
                openModal() {
                    isOpen.value = true
                },
            }
        },
        // data(){
        //     return {
        //         isOpen:false,
        //     }
        // },
        // methods: {
        //      closeModal() {
        //         this.isOpen = false
        //     },
        //     openModal() {
        //         this.isOpen = true
        //     },
        // },
    }

</script>

<style lang="scss" scoped>

</style>
