<template>
    <div v-if="isVisible" class="modal-overlay" @click.self="close">
        <div class="modal">
            <h2>Edit Todo</h2>
            <input v-model="editedTodo.text" placeholder="Edit todo" />
            <button @click="save">Save</button>
            <button @click="close">Cancel</button>
        </div>
    </div>
</template>

<script>
import { ref } from 'vue';

export default {
    props: {
        isVisible: {
            type: Boolean,
            required: true
        },
        todo: {
            type: Object,
            required: true
        }
    },
    emits: ['update-todo', 'close'],
    setup(props, { emit }) {
        const editedTodo = ref({ ...props.todo });

        const save = () => {
            emit('update-todo', editedTodo.value);
            emit('close');
        };

        const close = () => {
            emit('close');
        };

        return {
            editedTodo,
            save,
            close
        };
    }
};
</script>

<style scoped>
.modal-overlay {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.5);
    display: flex;
    align-items: center;
    justify-content: center;
}

.modal {
    background: white;
    padding: 20px;
    border-radius: 4px;
    max-width: 400px;
    width: 100%;
}
</style>
