<template>
    <div class="modal-backdrop">
        <div class="modal">
            <header class="modal-header">
                <slot name="header">
                    Edit Todo
                </slot>
                <button type="button" class="btn-close" @click="close">
                    x
                </button>
            </header>

            <section class="modal-body">
                <input type="text" v-model="todo.title">
            </section>

            <footer class="modal-footer">
                <button type="button" class="btn-green" @click="save">
                    Save Changes
                </button>
            </footer>
        </div>
    </div>
</template>

<script setup>
import axios from 'axios';
import { defineProps, defineEmits, ref } from 'vue';

const props = defineProps({
    todoID: {
        type: Number,
        required: true
    }
});

const todo = ref({});

const emit = defineEmits(['close', 'save']);

const close = () => {
    emit('close');
};

const save = () => {
    emit('save', todo.value.title);
    close();
};

const getTodo = async () => {
    try {
        console.log(props.todoID);
        const response = await axios.get(`http://localhost:8000/api/todos/${props.todoID}`);
        todo.value = response.data;
    } catch (e) {
        console.error('Error fetching todo:', e);
    }
};

getTodo();

</script>

<style scoped>
.modal-backdrop {
    position: fixed;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
    background-color: rgba(0, 0, 0, 0.3);
    display: flex;
    justify-content: center;
    align-items: center;
}

.modal {
    width: 400px;
    background: #FFFFFF;
    box-shadow: 2px 2px 20px 1px;
    overflow-x: auto;
    display: flex;
    flex-direction: column;
    border-radius: 10px;
}

.modal-header,
.modal-footer {
    padding: 15px;
    display: flex;
}

.modal-header {
    position: relative;
    border-bottom: 1px solid #eeeeee;
    color: #0582ca;
    justify-content: space-between;
}

.modal-footer {
    border-top: 1px solid #eeeeee;
    flex-direction: column;
    justify-content: flex-end;
}

.modal-body {
    position: relative;
    padding: 20px 10px;
}

.btn-close {
    position: absolute;
    top: 0;
    right: 0;
    border: none;
    font-size: 20px;
    padding: 10px;
    cursor: pointer;
    font-weight: bold;
    color: #0582ca;
    background: transparent;
}

.btn-green {
    color: white;
    background: #0582ca;
    border: 1px solid #0582ca;
    border-radius: 2px;
}

.modal-body input {
    width: 100%;
    font-size: 20px;
    padding: 10px;
    border: 1px solid #000000;
    border-radius: 5px;
    margin-bottom: 10px;
}
</style>