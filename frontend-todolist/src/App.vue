<template>
  <main class="app">
    <Greeting />
    <CreateTodo @reloadList="getToDoList" />
    <TodoList :todos="todos" @reloadList="getToDoList" />
  </main>
</template>

<script setup>
import { ref } from 'vue';
import axios from 'axios';
import Greeting from './components/Greeting.vue';
import CreateTodo from './components/CreateTodo.vue';
import TodoList from './components/TodoList.vue';

const todos = ref([]);

const getToDoList = async () => {
  try {
    const response = await axios.get('http://localhost:8000/api/todos');
    todos.value = response.data;
  } catch (error) {
    console.error('Error fetching todos:', error);
  }
}

getToDoList();

</script>

<style scoped></style>