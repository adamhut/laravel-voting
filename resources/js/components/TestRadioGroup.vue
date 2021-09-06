<template>
    <div class="container mx-auto px-2">
        <h2 class="font-bold text-2xl pt-2">Radio Group</h2>

        <!--Start of the Menu-->
        <div class="mt-4">
            <RadioGroup v-model="plan" class="max-w-md mt-8">
                <RadioGroupLabel class="font-bold">Plan</RadioGroupLabel>
                <div class="space-y-4">
                     <RadioGroupOption
                        class="bg-white rounded-md shadow cursor-pointer"
                        v-slot="{ checked }"
                        value="startup"
                    >
                        <div
                            class="flex items-center justify-between rounded-md px-4 py-4 "
                            :class="checked ? 'bg-blue-500 text-white' : ''"
                        >
                            <div>
                                <div class="font-bold"> Startup</div>
                                <div>12GB/6 CPUs · 160 GB SSD disk</div>
                            </div>
                            <div v-show="checked">
                                <CheckCircleIcon class="text-white h-6 w-6"></CheckCircleIcon>
                            </div>
                        </div>
                    </RadioGroupOption>
                    <RadioGroupOption
                        class="bg-white rounded-md shadow  cursor-pointer"
                        v-slot="{ checked }"
                        value="business"
                    >
                        <div
                            class="flex items-center justify-between rounded-md px-4 py-4 "
                            :class="checked ? 'bg-blue-500 text-white' : ''"
                        >
                            <div>
                                <div class="font-bold"> Business</div>
                                <div>16GB/8 CPUs · 512 GB SSD disk</div>
                            </div>
                            <div v-show="checked">
                                <CheckCircleIcon class="text-white h-6 w-6"></CheckCircleIcon>
                            </div>
                        </div>
                    </RadioGroupOption>
                    <RadioGroupOption
                        class="bg-white rounded-md shadow  cursor-pointer"
                        v-slot="{ checked }"
                        value="enterprise"
                    >
                        <div
                            class="flex items-center justify-between rounded-md px-4 py-4 "
                            :class="checked ? 'bg-blue-500 text-white' : ''"
                        >
                            <div>
                                <div class="font-bold"> Enterprise</div>
                                <div>32GB/12 CPUs · 1024 GB SSD disk</div>
                            </div>
                            <div v-show="checked">
                                <CheckCircleIcon class="text-white h-6 w-6"></CheckCircleIcon>
                            </div>
                        </div>
                    </RadioGroupOption>
                </div>
            </RadioGroup>
        </div>

        <h2 class="font-bold text-2xl mt-12">Game Selection</h2>

        <!--Start of the Menu-->
        <div class="mt-4">
            <RadioGroup v-model="gameSelection" class="max-w-md mt-8 font-mono">
                <RadioGroupLabel class="font-bold">Video Game Menu</RadioGroupLabel>
                <div class="space-y-4">
                     <RadioGroupOption
                        class="text-center focus:outline-none cursor-pointer"
                        v-slot="{ checked }"
                        value="new game"
                    >
                        <div
                            class="border border-transparent px-4 py-4 "
                            :class="checked ? 'border-gray-500' : ''"
                        >
                            <div class="font-bold">
                                New Game
                            </div>
                            <!-- <div v-show="checked">
                                <CheckCircleIcon class="text-white h-6 w-6"></CheckCircleIcon>
                            </div> -->
                        </div>
                    </RadioGroupOption>
                    <RadioGroupOption
                        class="text-center focus:outline-none cursor-pointer"
                        v-slot="{ checked }"
                        value="load game"
                    >
                        <div
                            class="border border-transparent px-4 py-4 "
                            :class="checked ? 'border-gray-500' : ''"
                        >
                            <div class="font-bold">
                                Load Game
                            </div>
                            <!-- <div v-show="checked">
                                <CheckCircleIcon class="text-white h-6 w-6"></CheckCircleIcon>
                            </div> -->
                        </div>
                    </RadioGroupOption>
                    <RadioGroupOption
                        class="text-center focus:outline-none cursor-pointer"
                        v-slot="{ checked }"
                        value="setting"
                    >
                        <div
                            class="border border-transparent px-4 py-4 "
                            :class="checked ? 'border-gray-500' : ''"
                        >
                            <div class="font-bold">
                                Setting
                            </div>
                            <!-- <div v-show="checked">
                                <CheckCircleIcon class="text-white h-6 w-6"></CheckCircleIcon>
                            </div> -->
                        </div>
                    </RadioGroupOption>
                </div>
            </RadioGroup>
        </div>
    </div>
</template>

<script>
  import { ref } from 'vue'
  import {
    RadioGroup,
    RadioGroupLabel,
    RadioGroupOption,
  } from '@headlessui/vue'
  import { CheckCircleIcon } from '@heroicons/vue/solid'
export default {
    components: {
        RadioGroup,
        RadioGroupLabel,
        RadioGroupOption,
        CheckCircleIcon
    },
    // data(){
    //     return {
    //         plan:'',
    //     }
    // },
    // mounted() {
    //     console.log(this.plan2);
    // },
    setup() {
        const plan = ref('startup')
        const gameSelection = ref('new game')


        return { plan,gameSelection }
    },
    // methods: {
    //     name() {

    //     }
    // },
}
</script>

<style lang="scss" scoped>

</style>