<script setup>
import { ref, onMounted } from 'vue';

const props = defineProps({
  message: String,
  type: String,
  time: String,
});

const isVisible = ref(false);

const hideMessage = () => {
  isVisible.value = false;
}

onMounted(() => {
  isVisible.value = true;
});
</script>

<template>
    <div v-if="isVisible" :class="['flash-message', `flash-${type}`]">
      <div>{{ message }}</div>
      <span>
          {{ time }}
      </span>
       <button @click="hideMessage" class="p-1 transition-colors duration-300 transform rounded-md hover:bg-opacity-25 hover:bg-gray-600 focus:outline-none">
            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M6 18L18 6M6 6L18 18" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
        </button>
    </div>
</template>

<style scoped>
.flash-message {
  font-size: .95em;
  width: 300px;
  color: #fff;
  padding: 1rem;
  border-radius: 5px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  display: flex;
  flex-direction: row;
  justify-content: space-between;
  gap: 10px;
  margin-bottom: 10px;
  align-items: center;
}

.flash-error,
.flash-danger {
  background-color: #ff5252;
}

.flash-success {
  background-color: #4caf50;
}

.flash-warning {
  background-color: #ffab40;
}
</style>