<template>
    <nav class="fixed z-30 w-full bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700">
        <div class="px-3 py-1 lg:px-5 lg:pl-3">
            <div class="flex items-center justify-between">
                <div class="flex items-center justify-start">
                    <button id="toggleSidebarMobile" @click="toggle" aria-expanded="true" aria-controls="sidebar"
                            class="p-2 text-gray-600 rounded cursor-pointer lg:hidden hover:text-gray-900 hover:bg-gray-100 focus:bg-gray-100 dark:focus:bg-gray-700 focus:ring-2 focus:ring-gray-100 dark:focus:ring-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                        <svg id="toggleSidebarMobileHamburger" class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                             xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                  d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h6a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                                  clip-rule="evenodd"></path>
                        </svg>
                        <svg id="toggleSidebarMobileClose" class="hidden w-6 h-6" fill="currentColor"
                             viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                  d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                  clip-rule="evenodd"></path>
                        </svg>
                    </button>
                    <a href="/" class="flex ml-2 md:mr-24">
                        <!--                        <svg data-v-6805eed4="" height="90px" version="1.0" xmlns="http://www.w3.org/2000/svg"-->
                        <!--                             xmlns:xlink="http://www.w3.org/1999/xlink" width="100%"-->
                        <!--                             viewBox="0 0 340.000000 250.000000" preserveAspectRatio="xMidYMid meet"-->
                        <!--                             color-interpolation-filters="sRGB" style="margin: auto;">-->
                        <!--                            <rect data-v-6805eed4="" x="0" y="0" width="100%" height="100%" fill="#fff" fill-opacity="1"-->
                        <!--                                  class="background"></rect>-->
                        <!--                            <g data-v-6805eed4="" fill="#333" class="icon-text-wrapper icon-svg-group iconsvg"-->
                        <!--                               transform="translate(74.2750015258789,90.23199462890625)">-->
                        <!--                                <g class="iconsvg-imagesvg" transform="translate(0,1.5983085632324219)">-->
                        <!--                                    <g>-->
                        <!--                                        <rect fill="#333" fill-opacity="0" stroke-width="2" x="0" y="0" width="60"-->
                        <!--                                              height="66.33939233116625" class="image-rect"></rect>-->
                        <!--                                        <svg x="0" y="0" width="60" height="66.33939233116625"-->
                        <!--                                             filtersec="colorsb4480776170" class="image-svg-svg primary"-->
                        <!--                                             style="overflow: visible;">-->
                        <!--                                            <svg xmlns="http://www.w3.org/2000/svg"-->
                        <!--                                                 viewBox="-0.0000019073486328125 -0.2357761561870575 90.87000274658203 100.4715347290039">-->
                        <!--                                                <title>资源 298</title>-->
                        <!--                                                <g fill-rule="evenodd">-->
                        <!--                                                    <path-->
                        <!--                                                        d="M27 71a2.38 2.38 0 0 0 4.76.09V5.56a5.56 5.56 0 1 1 11.11 0v88.88a5.56 5.56 0 1 1-11.11 0V83.73a2.38 2.38 0 0 0-4.76-.09v-.31a5.56 5.56 0 1 1-11.11 0V52.38a2.38 2.38 0 0 0-4.76-.09v15.57a5.56 5.56 0 0 1-11.13 0V32.14a5.56 5.56 0 0 1 11.11 0v.4a2.38 2.38 0 0 0 4.76.09v-16a5.56 5.56 0 1 1 11.11 0z"-->
                        <!--                                                        fill="#333"></path>-->
                        <!--                                                    <path-->
                        <!--                                                        d="M63.89 29a2.38 2.38 0 0 0-4.76-.09v65.53a5.56 5.56 0 1 1-11.11 0V5.56a5.56 5.56 0 1 1 11.11 0v10.71a2.38 2.38 0 0 0 4.76.09v.31a5.56 5.56 0 1 1 11.11 0v30.95a2.38 2.38 0 0 0 4.76.09V32.14a5.56 5.56 0 0 1 11.11 0v35.72a5.56 5.56 0 0 1-11.11 0v-.4a2.38 2.38 0 0 0-4.76-.09v16a5.56 5.56 0 1 1-11.11 0z"-->
                        <!--                                                        fill="#eb6621"></path>-->
                        <!--                                                </g>-->
                        <!--                                            </svg>-->
                        <!--                                        </svg> &lt;!&ndash;&ndash;&gt;</g>-->
                        <!--                                </g>-->
                        <!--                                <g transform="translate(67,0)">-->
                        <!--                                    <g data-gra="path-name" fill-rule="" class="tp-name iconsvg-namesvg">-->
                        <!--                                        <g transform="scale(1)">-->
                        <!--                                            <g>-->
                        <!--                                                <path-->
                        <!--                                                    d="M2.93-31.41L2.93-6.28C2.93-2.82 5.75 0 9.21 0L40.52 0 40.52-4.24 9.21-4.24C8.11-4.24 7.17-5.18 7.17-6.28L7.17-31.41C7.17-32.52 8.11-33.46 9.21-33.46L40.52-33.46 40.52-37.7 9.21-37.7C5.75-37.7 2.93-34.88 2.93-31.41ZM46.07-31.41L46.07 0 50.31 0 50.31-13.77 79.53-13.77 79.53 0 83.77 0 83.77-31.41C83.77-34.88 80.95-37.7 77.49-37.7L52.36-37.7C48.89-37.7 46.07-34.88 46.07-31.41ZM52.36-33.46L77.49-33.46C78.59-33.46 79.53-32.52 79.53-31.41L79.53-18.01 50.31-18.01 50.31-31.41C50.31-32.52 51.25-33.46 52.36-33.46ZM121.1-37.64L89.69-37.64 89.69 0 93.93 0 93.93-14.24C94.97-14.1 95.65-14.03 95.97-14.03L109.79-14.03 121.57 0 127.17 0 115.34-14.03 121.1-14.03C124.56-14.03 127.38-16.85 127.38-20.31L127.38-31.36C127.38-34.82 124.56-37.64 121.1-37.64ZM93.93-20.31L93.93-31.36C93.93-32.47 94.86-33.4 95.97-33.4L121.1-33.4C122.21-33.4 123.09-32.47 123.09-31.36L123.09-20.31C123.09-19.21 122.21-18.32 121.1-18.32L95.97-18.32C94.86-18.32 93.93-19.21 93.93-20.31Z"-->
                        <!--                                                    transform="translate(-2.930000066757202, 37.70000076293945)"></path>-->
                        <!--                                            </g> &lt;!&ndash;&ndash;&gt; &lt;!&ndash;&ndash;&gt; &lt;!&ndash;&ndash;&gt; &lt;!&ndash;&ndash;&gt; &lt;!&ndash;&ndash;&gt; &lt;!&ndash;&ndash;&gt;-->
                        <!--                                            <g data-gra="path-name-1" fill="#333"-->
                        <!--                                               transform="translate(0,40.70000076293945)">-->
                        <!--                                                <g transform="scale(0.98015)">-->
                        <!--                                                    <path-->
                        <!--                                                        d="M26.76-29.37L2.25-29.37 2.25 0 5.56 0 5.56-11.11C6.37-11 6.9-10.95 7.15-10.95L17.94-10.95 27.13 0 31.5 0 22.27-10.95 26.76-10.95C29.46-10.95 31.66-13.15 31.66-15.85L31.66-24.47C31.66-27.17 29.46-29.37 26.76-29.37ZM5.56-15.85L5.56-24.47C5.56-25.34 6.29-26.07 7.15-26.07L26.76-26.07C27.63-26.07 28.31-25.34 28.31-24.47L28.31-15.85C28.31-14.99 27.63-14.3 26.76-14.3L7.15-14.3C6.29-14.3 5.56-14.99 5.56-15.85ZM62.92-29.42L36.07-29.42 36.07 0 62.92 0 62.92-3.31 39.38-3.31 39.38-13.03 58.3-13.03 58.3-16.38 39.38-16.38 39.38-26.11 62.92-26.11ZM93.39-29.42L93.39-3.76 71.82-29.42 67.29-29.42 67.29 0 70.6 0 70.6-25.66 92.17 0 96.7 0 96.7-29.42ZM99.81-29.42L99.81-26.11 112.88-26.11 112.88 0 116.19 0 116.19-26.11 129.22-26.11 129.22-29.42Z"-->
                        <!--                                                        transform="translate(-2.25, 29.420000076293945)"></path>-->
                        <!--                                                </g>-->
                        <!--                                            </g>-->
                        <!--                                        </g>-->
                        <!--                                    </g> &lt;!&ndash;&ndash;&gt;</g>-->
                        <!--                            </g>-->
                        <!--                            <defs v-gra="od"></defs>-->
                        <!--                        </svg>-->
                    </a>
                    <!--                    <form action="#" method="GET" class="hidden lg:block lg:pl-3.5">-->
                    <!--                        <label for="topbar-search" class="sr-only">Search</label>-->
                    <!--                        <div class="relative mt-1 lg:w-96">-->
                    <!--                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">-->
                    <!--                                <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>-->
                    <!--                            </div>-->
                    <!--                            <input type="text" name="email" id="topbar-search" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Search">-->
                    <!--                        </div>-->
                    <!--                    </form>-->
                </div>
                <div class="flex items-center">
                    <div class="hidden mr-3 -mb-1 sm:block">
                        <span></span>
                    </div>

                    <button id="toggleSidebarMobileSearch" type="button"
                            class="p-2 text-gray-500 rounded-lg lg:hidden hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                        <span class="sr-only">Search</span>
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                  d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                  clip-rule="evenodd"></path>
                        </svg>
                    </button>

                    <div class="flex items-center ml-3">
                        <div>
                            <button type="button"
                                    class="flex text-sm bg-gray-800 rounded-full focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600"
                                    id="user-menu-button-2" aria-expanded="false" data-dropdown-toggle="dropdown-2">
                                <span class="sr-only">Open user menu</span>
                                <img class="w-8 h-8 rounded-full"
                                     src="https://flowbite.com/docs/images/people/profile-picture-5.jpg"
                                     alt="user photo">
                            </button>
                        </div>

                        <div
                            class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded shadow dark:bg-gray-700 dark:divide-gray-600"
                            id="dropdown-2" data-popper-placement="bottom"
                            style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate(2476px, 61px);">
                            <div class="px-4 py-3" role="none">
                                <p class="text-sm text-gray-900 dark:text-white" role="none">
                                    {{ user.name }}
                                </p>
                                <p class="text-sm font-medium text-gray-900 truncate dark:text-gray-300" role="none">
                                    {{ user.email }}
                                </p>
                            </div>
                            <ul class="py-1" role="none">
                                <li>
                                    <a href="#" @click="logout"
                                       class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white"
                                       role="menuitem">Sign out</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</template>

<script>
import {UserService} from "../services/UserService";

export default {
    name: "Header",
    data: function () {
        return {
            'user': {
                'email': null,
                'name': null
            },
            sidebarVisible: false
        }
    },
    mounted() {
        UserService.currentUser()
            .then(response => this.user = response.data.user)
    },
    methods: {
        logout: function (event) {
            event.preventDefault()
            axios.post('/logout', {})
                .then(
                    document.location.href = '/'
                )
        },
        toggle: function () {
            if (this.sidebarVisible == false) {
                document.getElementById('sidebar').style.display = 'block'
                document.getElementById('toggleSidebarMobileHamburger').style.display = 'none'
                document.getElementById('toggleSidebarMobileClose').style.display = 'block'
                this.sidebarVisible = true
            } else {
                document.getElementById('sidebar').style.display = 'none'
                document.getElementById('toggleSidebarMobileHamburger').style.display = 'block'
                document.getElementById('toggleSidebarMobileClose').style.display = 'none'
                this.sidebarVisible = false
            }
        }
    }
}
</script>
