<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, usePage } from '@inertiajs/vue3';
import NumberAnimation from "vue-number-animation";
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import SchoolSelector from '@/Components/Schools/SchoolSelector.vue';
import School from '@/Components/Schools/School.vue';


const props = defineProps({
    students: Number,
    classes: Number,
    teachers: Number,
    schools: Object
})

let Schools = props.schools.data
const theFormat = (num) =>
    `${Number.parseFloat(num.toFixed(0))}`;


</script>

<template>

    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <svg class="size-4" viewBox="0 0 24 24" id="meteor-icon-kit__regular-dashboard" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M3 2C2.44772 2 2 2.44772 2 3V6C2 6.55228 2.44772 7 3 7H6C6.55228 7 7 6.55228 7 6V3C7 2.44772 6.55228 2 6 2H3ZM3 0H6C7.65685 0 9 1.34315 9 3V6C9 7.65685 7.65685 9 6 9H3C1.34315 9 0 7.65685 0 6V3C0 1.34315 1.34315 0 3 0ZM14 16H21C22.6569 16 24 17.3431 24 19V21C24 22.6569 22.6569 24 21 24H14C12.3431 24 11 22.6569 11 21V19C11 17.3431 12.3431 16 14 16ZM14 18C13.4477 18 13 18.4477 13 19V21C13 21.5523 13.4477 22 14 22H21C21.5523 22 22 21.5523 22 21V19C22 18.4477 21.5523 18 21 18H14ZM3 11H6C7.65685 11 9 12.3431 9 14V21C9 22.6569 7.65685 24 6 24H3C1.34315 24 0 22.6569 0 21V14C0 12.3431 1.34315 11 3 11ZM3 13C2.44772 13 2 13.4477 2 14V21C2 21.5523 2.44772 22 3 22H6C6.55228 22 7 21.5523 7 21V14C7 13.4477 6.55228 13 6 13H3ZM21 0C22.6569 0 24 1.34315 24 3V11C24 12.6569 22.6569 14 21 14H14C12.3431 14 11 12.6569 11 11V3C11 1.34315 12.3431 0 14 0H21ZM13 3V11C13 11.5523 13.4477 12 14 12H21C21.5523 12 22 11.5523 22 11V3C22 2.44772 21.5523 2 21 2H14C13.4477 2 13 2.44772 13 3Z"
                            fill="#758CA7" />
                    </svg>
                    <h2 class="ml-2 text-xl font-semibold leading-tight text-gray-800">Dashboard</h2>
                </div>
                <div class="mr-3">
                    <SchoolSelector :schools="Schools" />
                </div>
            </div>
        </template>

        <div class="px-4 py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
            <!-- Stats -->
            <div class="grid grid-cols-4 gap-4 py-10 md:grid-flow-col">
                <!-- schools -->
                <div
                    class="flex items-center justify-between max-w-md px-8 py-8 duration-300 bg-white border-t-4 border-indigo-600 shadow-md sm:rounded-lg hover:scale-105 hover:shadow-xl ">
                    <div class="text-xl font-semibold text-gray-900">
                        <p>Schools</p>
                        <span>{{ Schools.length }}</span>
                    </div>
                    <svg version="1.1" class="size-10 fill-indigo-500" xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512" xml:space="preserve" width="135px"
                        height="135px" fill="#000000">
                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                        <g id="SVGRepo_iconCarrier">
                            <g>
                                <polygon class="fill-indigo-700"
                                    points="470.323,22.908 41.678,22.908 14.868,122.136 497.131,122.136 "></polygon>
                                <polygon class="fill-indigo-700"
                                    points="369.865,175.265 256,128.862 142.134,175.265 142.134,89.745 256,27.865 369.865,89.745 ">
                                </polygon>
                                <rect x="205.697" y="359.133" class="fill-indigo-700" width="100.61" height="126.376">
                                </rect>
                            </g>
                            <g>
                                <path class="fill-indigo-500"
                                    d="M511.486,118.257l-26.808-99.228c-1.753-6.485-7.636-10.99-14.353-10.99H41.678 c-6.719,0-12.602,4.505-14.353,10.99l-26.81,99.228c-1.207,4.468-0.265,9.242,2.55,12.917c2.813,3.674,7.177,5.828,11.804,5.828 h24.254v352.091c0,8.211,6.658,14.868,14.868,14.868h88.144h227.733h88.144c8.21,0,14.868-6.656,14.868-14.868V248.077 c0-8.211-6.658-14.868-14.868-14.868c-8.21,0-14.868,6.656-14.868,14.868v226.15h-58.408V253.223 c0-8.211-6.658-14.868-14.868-14.868c-8.21,0-14.868,6.656-14.868,14.868v221.004H321.17V359.128 c0-8.211-6.658-14.868-14.868-14.868H205.698c-8.21,0-14.868,6.656-14.868,14.868v115.099h-33.829V253.223 c0-8.211-6.658-14.868-14.868-14.868s-14.868,6.656-14.868,14.868v221.004H68.858V137.004h58.408v38.261 c0,4.951,2.464,9.576,6.573,12.339c4.109,2.762,9.324,3.298,13.906,1.43l108.257-44.116l108.257,44.116 c1.808,0.736,3.712,1.099,5.608,1.099c2.914,0,5.809-0.856,8.296-2.529c4.109-2.762,6.573-7.388,6.573-12.339v-38.261h112.398 c4.627,0,8.992-2.154,11.804-5.828C511.749,127.5,512.692,122.725,511.486,118.257z M220.566,373.995h70.869v96.641h-70.869 V373.995z M135.034,76.682c-4.787,2.602-7.768,7.615-7.768,13.064v17.523H34.287l18.775-69.492h153.565L135.034,76.682z M354.999,153.15l-93.389-38.057c-1.798-0.733-3.704-1.099-5.61-1.099c-1.906,0-3.812,0.367-5.61,1.099l-93.389,38.057V98.587 L256,44.786l98.999,53.801V153.15z M384.735,107.268V89.745c0-5.449-2.981-10.462-7.768-13.064l-71.593-38.906h153.565 l18.775,69.492h-92.979V107.268z">
                                </path>
                                <path class="fill-indigo-500"
                                    d="M184.883,249.113c0,39.214,31.903,71.117,71.117,71.117s71.117-31.903,71.117-71.117 S295.214,177.994,256,177.994S184.883,209.899,184.883,249.113z M297.382,249.113c0,22.819-18.564,41.382-41.382,41.382 s-41.382-18.564-41.382-41.382s18.564-41.382,41.382-41.382S297.382,226.294,297.382,249.113z">
                                </path>
                                <path class="fill-indigo-500"
                                    d="M241.133,235.725v13.388c0,8.212,6.658,14.868,14.868,14.868h17.098 c8.21,0,14.868-6.656,14.868-14.868c0-8.211-6.658-14.868-14.868-14.868h-2.303c-0.742-7.517-7.083-13.388-14.795-13.388 C247.789,220.857,241.133,227.513,241.133,235.725z">
                                </path>
                            </g>
                        </g>
                    </svg>
    
                </div>
                    <!-- classes -->
                <Link :href="route('classes.index')"
                    class="flex items-center justify-between max-w-md px-8 py-8 duration-300 bg-white border-t-4 border-indigo-600 shadow-md sm:rounded-lg hover:scale-105 hover:shadow-xl ">
                    <div class="text-xl font-semibold text-gray-900">
                        <p>Class Rooms</p>
                        <NumberAnimation ref="number1" :from="0" :to="classes" :format="theFormat" :duration="4" autoplay
                            easing="easeInOutSine" />
                    </div>
                    <svg class="size-10 fill-indigo-700" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512.001 512.001" xml:space="preserve">
                        <g>
                            <g>
                                <path d="M467.309,16.768H221.454c-6.128,0-11.095,4.967-11.095,11.095v86.451l12.305-7.64c3.131-1.945,6.475-3.257,9.884-3.978
                V38.958h223.665v160.016H232.549v-25.89l-22.19,13.778v23.208c0,6.128,4.967,11.095,11.095,11.095h245.855
                c6.127,0,11.095-4.967,11.095-11.095V27.863C478.404,21.735,473.436,16.768,467.309,16.768z" />
                            </g>
                        </g>
                        <g>
                            <g>
                                <path d="M306.001,78.356c-2.919-3.702-8.285-4.335-11.986-1.418l-38.217,30.133c3.649,2.385,6.85,5.58,9.301,9.527
                c0.695,1.117,1.298,2.266,1.834,3.431l37.651-29.687C308.286,87.424,308.92,82.057,306.001,78.356z" />
                            </g>
                        </g>
                        <g>
                            <g>
                                <circle cx="121.535" cy="31.935" r="31.935" />
                            </g>
                        </g>
                        <g>
                            <g>
                                <path d="M252.01,124.728c-4.489-7.229-13.987-9.451-21.218-4.963l-31.206,19.375c-0.13-25.879-0.061-12.145-0.144-28.811
                c-0.101-20.005-16.458-36.281-36.464-36.281h-15.159c-12.951,33.588-8.779,21.12-19.772,49.63l4.623-20.131
                c0.32-1.508,0.088-3.08-0.655-4.43l-6.264-11.393l5.559-10.109c0.829-1.508-0.264-3.356-1.985-3.356h-15.271
                c-1.72,0-2.815,1.848-1.985,3.356l5.57,10.13l-6.276,11.414c-0.728,1.325-0.966,2.865-0.672,4.347l4.005,20.172
                c-2.159-5.599-17.084-44.306-19.137-49.63H80.093c-20.005,0-36.363,16.275-36.464,36.281l-0.569,113.2
                c-0.042,8.51,6.821,15.443,15.331,15.486c0.027,0,0.052,0,0.079,0c8.473,0,15.364-6.848,15.406-15.331l0.569-113.2
                c0-0.018,0-0.036,0-0.053c0.024-1.68,1.399-3.026,3.079-3.013c1.68,0.012,3.034,1.378,3.034,3.058l0.007,160.381
                c14.106-0.6,27.176,4.488,36.981,13.423v-62.568h7.983v71.773c5.623,8.268,8.914,18.243,8.914,28.974
                c0,9.777-2.732,18.928-7.469,26.731c4.866,0.023,9.592,0.669,14.099,1.861c6.076-5.271,13.385-9.151,21.437-11.136
                c0-279.342-0.335-106.627-0.335-229.418c0-1.779,1.439-3.221,3.218-3.224c1.779-0.004,3.224,1.432,3.232,3.211
                c0.054,10.807,0.224,44.59,0.283,56.351c0.028,5.579,3.07,10.708,7.953,13.407c4.874,2.694,10.835,2.554,15.583-0.394
                l54.604-33.903C254.276,141.458,256.499,131.957,252.01,124.728z" />
                            </g>
                        </g>
                        <g>
                            <g>
                                <circle cx="429.221" cy="322.831" r="33.803" />
                            </g>
                        </g>
                        <g>
                            <g>
                                <path d="M511.459,405.811c-0.107-21.176-17.421-38.404-38.598-38.404c-9.137,0-76.583,0-84.781,0
                c3.637,7.068,5.704,15.069,5.704,23.55c0,9.005-2.405,18.413-7.5,26.782c18.904,0.764,35.468,10.91,45.149,25.897h40.579v-37.43
                c0-1.842,1.46-3.352,3.301-3.415s3.402,1.345,3.526,3.182c0,0,0,0.001,0,0.002l0.19,37.661h32.621L511.459,405.811z" />
                            </g>
                        </g>
                        <g>
                            <g>
                                <path d="M290.469,390.956c0-8.629,2.138-16.763,5.894-23.92c-22.009,0-47.852,0-75.267,0c3.472,6.939,5.437,14.756,5.437,23.029
                c0,9.721-2.73,18.926-7.469,26.731c15.558,0.074,29.912,6.538,40.283,17.267c10.054-9.822,23.759-15.914,38.836-15.995
                C292.948,409.616,290.469,400.126,290.469,390.956z" />
                            </g>
                        </g>
                        <g>
                            <g>
                                <path d="M264.819,288.655c-18.668,0-33.804,15.132-33.804,33.803c0,18.628,15.107,33.803,33.804,33.803
                c18.518,0,33.803-14.965,33.803-33.803C298.622,303.808,283.517,288.655,264.819,288.655z" />
                            </g>
                        </g>
                        <g>
                            <g>
                                <path d="M123.217,390.065c0-8.252,1.956-16.053,5.411-22.98c-1.457-0.072,4.672-0.049-89.485-0.049
                c-21.068,0-38.491,17.138-38.598,38.404l-0.192,38.196c14.907,0,17.906,0,32.621,0l0.191-38.031
                c0.01-1.884,1.541-3.402,3.423-3.397c1.882,0.006,3.404,1.532,3.404,3.414v38.014h45.727c9.855-15.754,26.8-25.646,45.243-26.406
                C125.956,409.168,123.217,399.865,123.217,390.065z" />
                            </g>
                        </g>
                        <g>
                            <g>
                                <path d="M82.786,288.655c-18.668,0-33.803,15.134-33.803,33.803c0,18.584,15.046,33.803,33.803,33.803
                c18.536,0,33.804-15.015,33.804-33.803C116.59,303.788,101.455,288.655,82.786,288.655z" />
                            </g>
                        </g>
                        <g>
                            <g>
                                <path d="M422.533,473.807c-0.105-21.178-17.42-38.406-38.597-38.406c-2.246,0-82.969,0-85.507,0
                c-21.176,0-39.601,17.227-39.708,38.404l-0.275-0.891c-0.105-21.092-17.341-38.404-38.597-38.404c-24.544,0-59.795,0-85.507,0
                c-21.176,0-39.601,17.227-39.708,38.404L94.442,512h32.621l0.191-38.922c0.008-1.622,1.327-2.93,2.948-2.926
                c1.621,0.004,2.932,1.32,2.932,2.941v38.908c19.121,0,68.483,0,86.392,0v-38.908c0-1.736,1.405-3.144,3.141-3.149
                c1.735-0.004,3.149,1.397,3.158,3.133l0.191,38.923c6.669,0,58.238,0,65.134,0l0.191-38.031c0,0,0-0.001,0-0.002
                c0.009-1.621,1.328-2.928,2.949-2.924c1.621,0.004,2.931,1.32,2.931,2.941v38.016c19.121,0,68.483,0,86.392,0v-38.016
                c0-1.736,1.405-3.144,3.141-3.149c1.735-0.004,3.149,1.397,3.158,3.133l0.191,38.031h32.621L422.533,473.807z" />
                            </g>
                        </g>
                        <g>
                            <g>
                                <circle cx="175.934" cy="389.933" r="34.198" />
                            </g>
                        </g>
                        <g>
                            <g>
                                <circle cx="342.07" cy="390.821" r="34.198" />
                            </g>
                        </g>
                    </svg>
                </Link>
                <!-- students -->
                <Link :href="route('students.index')"
                    class="flex items-center justify-between max-w-md px-8 py-8 duration-300 bg-white border-t-4 border-indigo-600 shadow-md sm:rounded-lg hover:scale-105 hover:shadow-xl ">
                    <div class="text-xl font-semibold text-gray-900">
                        <p>Students</p>
    
                        <NumberAnimation ref="number1" :from="0" :to="students" :format="theFormat" :duration="4" autoplay
                            easing="easeInOutSine" />
                    </div>
                    <svg class="size-10 fill-indigo-700" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 343.501 343.501" xml:space="preserve">
                        <path d="M64.552,332.042c-4.418,0-8-3.582-8-8v-29.46H44.534c-4.418,0-8-3.582-8-8s3.582-8,8-8h19.842
        c0.117-0.002,0.235-0.002,0.353,0h261.189c4.418,0,8,3.582,8,8s-3.582,8-8,8H72.552v29.46
        C72.552,328.46,68.971,332.042,64.552,332.042z M7.999,294.587c-1.001,0-2.02-0.189-3.005-0.589
        c-4.094-1.661-6.066-6.327-4.405-10.421l21.742-53.585c9.604-23.664,26.819-55.124,65.279-55.124h28.838
        c20.719,0,37.778,9.221,50.701,27.406c0.344,0.465,3.79,4.936,6.83,8.881c2.19,2.843,4.543,5.895,6.5,8.44
        c2.693,3.503,2.036,8.525-1.467,11.219c-3.503,2.694-8.525,2.036-11.218-1.467c-1.954-2.541-4.302-5.589-6.489-8.427
        c-5.854-7.598-6.933-9.003-7.213-9.399c-6.237-8.777-13.234-14.635-21.414-17.804l-24.187,33.144
        c-1.506,2.063-3.908,3.284-6.462,3.284s-4.956-1.221-6.462-3.284l-24.187-33.144c-14.029,5.446-24.739,18.92-34.224,42.291
        l-21.741,53.584C14.154,292.702,11.16,294.587,7.999,294.587z M89.109,190.869l12.921,17.706l12.921-17.706H89.109z
         M225.597,263.385h-87.934c-4.418,0-8-3.582-8-8s3.582-8,8-8h87.934c4.418,0,8,3.582,8,8S230.016,263.385,225.597,263.385z
         M335.502,196.862c-3.161,0-6.155-1.885-7.416-4.994l-17.976-44.304c-7.448-18.352-15.785-29.147-26.546-33.775l-19.345,26.509
        c-1.506,2.063-3.907,3.284-6.462,3.284c-2.555,0-4.956-1.221-6.462-3.284l-19.353-26.518c-6.102,2.61-11.376,7.17-16.115,13.838
        c-0.486,0.683-13.385,17.904-17.485,23.241c-2.692,3.504-7.714,4.161-11.218,1.47c-3.503-2.692-4.161-7.715-1.469-11.218
        c4.09-5.323,16.519-21.926,17.173-22.82c10.917-15.363,25.4-23.184,43.006-23.184h23.844c32.636,0,47.167,26.504,55.259,46.44
        l17.976,44.305c1.661,4.094-0.311,8.76-4.405,10.421C337.522,196.672,336.503,196.862,335.502,196.862z M249.799,111.107
        l7.958,10.903l7.957-10.903H249.799z M297.508,180.639H177.147c-4.418,0-8-3.582-8-8s3.582-8,8-8h120.361c4.418,0,8,3.582,8,8
        S301.926,180.639,297.508,180.639z M102.03,160.667c-23.977,0-43.483-19.507-43.483-43.484c0-19.743,13.228-36.456,31.285-41.742
        c0.093-0.03,0.188-0.059,0.283-0.086c2.178-0.619,4.402-1.066,6.651-1.338c1.402-0.17,2.827-0.273,4.267-0.306
        c0.017-0.011,0.03-0.001,0.046-0.002c0.015-0.001,0.031,0,0.045-0.001c0.013,0,0.027,0,0.04,0c0.011-0.001,0.021-0.001,0.035-0.001
        c0.256-0.005,0.518-0.012,0.769-0.008c0.016-0.001,0.034-0.001,0.054,0c0.004,0,0.009,0,0.009,0c0.011,0,0.019-0.001,0.031,0
        c0.022,0,0.043,0,0.065,0h0c0.012,0,0.024,0.001,0.034,0c0.011,0,0.022,0,0.034,0c0.012,0,0.027,0,0.036,0
        c0.012,0,0.026,0.001,0.038,0.001c0.013,0,0.027,0,0.04,0c0.001,0,0.004,0,0.005,0c22.137,0.14,40.463,16.636,42.925,38.576
        c0.182,1.61,0.275,3.248,0.275,4.906C145.512,141.161,126.006,160.667,102.03,160.667z M86.71,94.375
        c-7.333,4.941-12.164,13.32-12.164,22.808c0,15.155,12.329,27.484,27.483,27.484c13.166,0,24.198-9.305,26.867-21.685
        c-0.429,0.013-0.859,0.019-1.289,0.019C108.849,123.001,92.781,111.254,86.71,94.375z M102.053,89.7
        c4.037,10.228,13.96,17.281,25.504,17.302c-4.022-10.049-13.814-17.189-25.256-17.301c-0.013,0-0.027,0-0.04,0
        c-0.012,0.001-0.025,0.001-0.039,0c-0.012-0.001-0.026-0.002-0.04-0.001c-0.013,0-0.026,0-0.039,0c-0.014,0-0.027,0-0.04,0
        C102.087,89.699,102.071,89.699,102.053,89.7z M257.757,86.136c-20.588,0-37.338-16.75-37.338-37.338
        c0-20.589,16.75-37.34,37.338-37.34c20.589,0,37.339,16.751,37.339,37.34C295.096,69.386,278.345,86.136,257.757,86.136z
         M257.757,27.458c-11.766,0-21.338,9.573-21.338,21.34c0,11.766,9.572,21.338,21.338,21.338c11.767,0,21.339-9.572,21.339-21.338
        C279.096,37.032,269.523,27.458,257.757,27.458z" />
                    </svg>
    
                </Link>
                <!-- teachers -->
                <Link :href="route('teachers.index')"
                    class="flex items-center justify-between max-w-md px-8 py-8 duration-300 bg-white border-t-4 border-indigo-600 shadow-md sm:rounded-lg hover:scale-105 hover:shadow-xl">
                    <div class="text-xl font-semibold text-gray-900">
                        <p>Teachers</p>
                        <NumberAnimation ref="number1" :from="0" :to="teachers" :format="theFormat" :duration="4" autoplay
                            easing="easeInOutSine" />
                    </div>
                    <svg class="size-10 fill-indigo-700" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 511.999 511.999" xml:space="preserve">
                        <g>
                            <g>
                                <path d="M302.195,11.833H13.049C5.842,11.833,0,17.675,0,24.882v214.289c0,7.207,5.842,13.049,13.049,13.049h283.839
                l-34.352-21.329c-2.247-1.396-4.282-3.002-6.109-4.768H26.097V37.93h263.049v126.703c4.01,0.847,7.943,2.39,11.625,4.677
                l14.473,8.986V24.882C315.244,17.675,309.402,11.833,302.195,11.833z" />
                            </g>
                        </g>
                        <g>
                            <g>
                                <path d="M216.857,134.337c-4.352-3.43-10.665-2.685-14.097,1.668c-3.432,4.353-2.686,10.665,1.668,14.097l44.279,34.914
                c0.63-1.371,1.34-2.719,2.156-4.034c2.883-4.643,6.649-8.401,10.94-11.206L216.857,134.337z" />
                            </g>
                        </g>
                        <g>
                            <g>
                                <circle cx="419.71" cy="81.405" r="37.557" />
                            </g>
                        </g>
                        <g>
                            <g>
                                <path d="M511.33,173.609c-0.118-23.528-19.355-42.67-42.884-42.67H450.26c-17.831,46.242-11.329,29.381-22.507,58.37l4.709-23.724
                c0.346-1.744,0.067-3.555-0.79-5.113l-7.381-13.424l6.551-11.914c0.454-0.826,0.438-1.829-0.041-2.64
                c-0.479-0.811-1.352-1.308-2.293-1.308h-17.96c-0.942,0-1.813,0.497-2.293,1.308s-0.495,1.815-0.041,2.64l6.537,11.889
                l-7.367,13.4c-0.873,1.589-1.147,3.438-0.77,5.211l5.438,23.675c-3.119-8.087-21.08-52.728-23.255-58.37h-17.83
                c-23.529,0-42.766,19.141-42.884,42.67c-0.098,19.565-0.016,3.179-0.17,33.884l-36.702-22.787
                c-8.501-5.28-19.674-2.667-24.953,5.836c-5.279,8.503-2.666,19.675,5.836,24.954l64.219,39.873
                c12.028,7.47,27.609-1.167,27.68-15.304c0.036-7.091,0.292-57.809,0.334-66.275c0.013-2.092,1.714-3.776,3.805-3.769
                c2.089,0.007,3.779,1.703,3.779,3.794c-0.018,87.323-0.394,111.735-0.394,304.606c0,12.01,9.736,21.746,21.746,21.746
                s21.746-9.736,21.746-21.746V304.604h9.388v173.817c0,12.01,9.736,21.746,21.746,21.746s21.746-9.736,21.746-21.746l0.008-304.612
                c0-1.981,1.604-3.589,3.586-3.595c1.981-0.006,3.595,1.594,3.605,3.577l0.669,133.132c0.05,9.977,8.154,18.03,18.119,18.03
                c0.031,0,0.062,0,0.094,0c10.007-0.05,18.081-8.205,18.03-18.212L511.33,173.609z" />
                            </g>
                        </g>
                    </svg>
                </Link>
                <!-- other stats -->
    
            </div>
    
            <!-- schools -->
            <div class="flex flex-col mt-8">
                <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                        <div class="relative overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-300">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col"
                                            class="py-3.5 pr-3 pl-4 text-sm font-semibold text-left text-gray-900 sm:pl-6">
                                            NO
                                        </th>
                                        <th scope="col"
                                            class="py-3.5 pr-3 pl-4 text-sm font-semibold text-left text-gray-900 sm:pl-6">
                                            School Name
                                        </th>
                                        <th scope="col" class="px-3 py-3.5 text-sm font-semibold text-left text-gray-900">
                                            No of Students
                                        </th>
                                        <th scope="col" class="px-3 py-3.5 text-sm font-semibold text-left text-gray-900">
                                            Status
                                        </th>
                                        <th scope="col" class="relative py-3.5 pr-4 pl-3 sm:pr-6" />
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <tr v-for="( school, index) in Schools" :id="school.id">
                                        <School :school="school" :id="index" :students="students" />
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
