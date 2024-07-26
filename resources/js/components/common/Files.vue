<template>
  <div class="grid md:grid-cols-3 md:gap-6">
      <div>
          <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white mt-10">Файлы</h3>
          <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="file_input">Загрузить
              файл</label>
          <input @change="uploadFile"
                 class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                 aria-describedby="file_input_help" id="file_input" type="file">
          <div class="flex flex-row flex-wrap mt-5">
              <div v-for="file in files" :key="file.id"
                   class="max-w-[256px] max-h-[396px] bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 mr-2 mb-2">
                  <img class="rounded-t-lg max-w-[256px] max-h-[256px] m-auto" :src="getFileUrl(file.path)" :alt="file.filename"
                       :title="file.filename"/>
                  <div class="p-3 overflow-hidden">
                      <div class="mb-1 font-normal text-gray-700 dark:text-gray-400"> {{ file.filename }}
                      </div>
                      <div class="mb-1 font-normal text-gray-700 dark:text-gray-400">Размер: {{ file.filesize }} Мб
                      </div>
                      <div class="mb-1 font-normal text-gray-700 dark:text-gray-400">Сохранен: {{
                              file.created_at
                          }}
                      </div>
                      <div class="grid grid-cols-2">
                          <div class="grid justify-items-start">
                              <svg @click="downloadFile(file.id)"
                                   class="cursor-pointer w-6 h-6 text-gray-700 dark:text-white" aria-hidden="true"
                                   xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 19">
                                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M15 15h.01M4 12H2a1 1 0 0 0-1 1v4a1 1 0 0 0 1 1h16a1 1 0 0 0 1-1v-4a1 1 0 0 0-1-1h-3M9.5 1v10.93m4-3.93-4 4-4-4"/>
                              </svg>
                          </div>
                          <div class="grid justify-items-end">
                              <svg @click="deleteFile(file.id)"
                                   class="cursor-pointer w-6 h-6 text-gray-700 dark:text-white" aria-hidden="true"
                                   xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 20">
                                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M1 5h16M7 8v8m4-8v8M7 1h4a1 1 0 0 1 1 1v3H6V2a1 1 0 0 1 1-1ZM3 5h12v13a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V5Z"/>
                              </svg>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>

  </div>
</template>
<script>

import {FileService} from "../../services/FileService";
import { EventBus } from '../../helpers/eventBus';

export default {
  name: 'Files',
    components: {},
    props: {
        modelId: null,
        modelType: '',
    },
    data: function () {
        return {
            isHidden: true,
            errors: null,
            files: [],
        }
    },
    created: async function () {
        await this.loadFiles();
    },
    mounted: async function () {
        EventBus.on('refresh-files', this.loadFiles);
    },
    beforeDestroy() {
        EventBus.off('refresh-files', this.loadFiles);
    },
    methods: {
        showModal: function () {
            this.isHidden = false
        },
        closeModal: function () {
            this.isHidden = true
        },

        async loadFiles() {
            try {
                const response = await FileService.getFiles(this.modelType, this.modelId);
                this.files = response.data.data;
            } catch (error) {
                this.errors = error.response ? error.response.data.errors : [error.message];
            }
        },
        async uploadFile(event) {
            const file = event.target.files[0];
            let formData = new FormData();
            formData.append('file', file);

            try {
                await FileService.store(this.modelType, this.modelId, formData).then(response => {this.loadFiles()});
                this.errors = null;
            } catch (error) {
                this.errors = error.response.data.errors;
            }
        },
        async downloadFile(id) {
            try {
                const response = await FileService.download(id, { responseType: 'blob' });
                const url = window.URL.createObjectURL(new Blob([response.data]));
                const link = document.createElement('a');
                link.href = url;
                link.setAttribute('download', response.headers['content-disposition'].split('filename=')[1]);
                document.body.appendChild(link);
                link.click();
                link.remove();
            } catch (error) {
                this.errors = error.response ? error.response.data.errors : [error.message];
            }
        },
        async deleteFile(id) {
            try {
                await FileService.delete(id);
                this.files = this.files.filter(file => file.id !== id);
            } catch (error) {
                this.errors = error.response ? error.response.data.errors : [error.message];
            }
        },
        getFileUrl(path) {
            return `${import.meta.env.VITE_BASE_URL}/storage/${path}`;
        }
    }
}
</script>
