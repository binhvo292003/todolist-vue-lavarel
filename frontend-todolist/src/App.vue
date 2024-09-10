<script setup>
import { ref, onMounted, computed, watch } from 'vue'

const todos = ref([])
const show_all = ref(false)
const input_content = ref('')

const todos_asc = computed(() => {
  return todos.value.slice().sort((a, b) => {
    return a.title.localeCompare(b.title)
  })
})

const task_not_completed = computed(() => {
  return todos_asc.value.filter(todo => !todo.completed);
})

const filteredTodos = computed(() => {
  return show_all.value
    ? task_not_completed.value
    : todos_asc.value
})

watch(todos, addTodo)

async function addTodo() {
  if (input_content.value.trim() === '') {
    return;
  }

  const newTodo = {
    title: input_content.value,
    completed: false,
    editable: false,
    createdAt: new Date().getTime()
  }

  const res = await fetch('http://127.0.0.1:8000/api/todos', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json'
    },
    body: JSON.stringify(newTodo)
  })

  fetchData();
  input_content.value = ""
}

const removeTodo = async (todo) => {
  await fetch(`http://127.0.0.1:8000/api/todos/${todo.id}`, {
    method: 'DELETE'
  })
  todos.value = todos.value.filter((t) => t !== todo)
}

const updateTodo = async (todo) => {
  await fetch(`http://127.0.0.1:8000/api/todos/${todo.id}`, {
    method: 'PUT',
    headers: {
      'Content-Type': 'application/json'
    },
    body: JSON.stringify(todo)
  })
}

const toggleShowAll = () => {
  show_all.value = !show_all.value;
}

const clearStorage = async () => {
  await fetch('http://127.0.0.1:8000/api/todos', {
    method: 'DELETE'
  })
  todos.value = []
}

async function fetchData() {
  const res = await fetch('http://127.0.0.1:8000/api/todos')
  todos.value = await res.json();
}

onMounted(() => {
  fetchData()
})

</script>

<template>
  <main class="app">

    <section class="greeting">
      <h2 class="caption">
        Welcome to Todolist Website
      </h2>
    </section>

    <section class="create-todo">
      <h3>CREATE A TASK</h3>

      <form id="new-todo-form" @submit.prevent="addTodo()">
        <input type="text" name="content" id="content" placeholder="e.g. make a video" v-model="input_content" />
        <input type="submit" value="Add todo" />
      </form>

    </section>

    <section class="todo-list">
      <h3>TODO LIST</h3>
      <div class="actions">
        <button class="done-items" @click="toggleShowAll()">Show Task Not Complete</button>
        <button class="done-items" @click="clearStorage()">Clear</button>
      </div>
      <div class="list" id="todo-list">
        <div v-for="todo in filteredTodos" :class="`todo-item ${todo.completed && 'done'}`">
          <label>
            <input type="checkbox" v-model="todo.completed" @change="updateTodo(todo)" />
            <span class="bubble business"></span>
          </label>

          <div class="todo-content">
            <input type="text" v-model="todo.title" @blur="updateTodo(todo)" />
          </div>

          <div class="actions">
            <button class="delete" @click="removeTodo(todo)">Delete</button>
            <button class="edit" @click="">Edit</button>
          </div>
        </div>
      </div>
    </section>

  </main>
</template>

<style scoped>
#new-todo-form {
  display: flex;
  flex-direction: row;
  gap: 10px;
}
</style>