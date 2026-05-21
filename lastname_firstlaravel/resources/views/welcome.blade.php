<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>📚 School Flow • Assignment Manager</title>
        <script src="https://cdn.tailwindcss.com"></script>
        <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        />

        <!-- Separated Custom CSS -->
        <link rel="stylesheet" href="{{ asset('style.css') }}" />
    </head>
    <body class="bg-zinc-950 text-zinc-100 min-h-screen">
        <div class="max-w-7xl mx-auto p-8">
            <!-- Header -->
            <div class="flex items-center justify-between mb-10">
                <div class="flex items-center gap-3">
                    <div
                        class="w-10 h-10 bg-indigo-600 rounded-2xl flex items-center justify-center text-2xl"
                    >
                        📚
                    </div>
                    <h1
                        class="title-font text-4xl font-semibold tracking-tighter"
                    >
                        School Flow
                    </h1>
                    <span
                        class="px-3 py-1 text-xs font-medium bg-zinc-800 text-indigo-400 rounded-3xl"
                        >Assignments</span
                    >
                </div>

                <div class="flex items-center gap-4">
                    <div
                        onclick="showStats()"
                        class="flex items-center gap-2 bg-zinc-900 hover:bg-zinc-800 px-5 py-2.5 rounded-3xl cursor-pointer transition-colors"
                    >
                        <i class="fa-solid fa-chart-simple"></i>
                        <span class="font-medium text-sm">Progress</span>
                    </div>

                    <div
                        onclick="exportData()"
                        class="flex items-center gap-2 bg-zinc-900 hover:bg-zinc-800 px-5 py-2.5 rounded-3xl cursor-pointer transition-colors"
                    >
                        <i class="fa-solid fa-download"></i>
                        <span class="font-medium text-sm">Export</span>
                    </div>

                    <div
                        onclick="clearAllData()"
                        class="flex items-center gap-2 text-red-400 hover:text-red-500 px-5 py-2.5 rounded-3xl cursor-pointer transition-colors"
                    >
                        <i class="fa-solid fa-trash"></i>
                        <span class="font-medium text-sm">Reset</span>
                    </div>

                    <div class="text-xs text-zinc-500 flex items-center gap-1">
                        <div
                            class="w-2 h-2 bg-emerald-400 rounded-full animate-pulse"
                        ></div>
                        Auto-saved
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-12 gap-8">
                <!-- Sidebar -->
                <div class="col-span-12 lg:col-span-3 space-y-6">
                    <!-- Quick Add -->
                    <div class="bg-zinc-900 rounded-3xl p-6">
                        <h2
                            class="text-lg font-semibold mb-4 flex items-center gap-2"
                        >
                            <i class="fa-solid fa-plus"></i> Quick Add
                            Assignment
                        </h2>
                        <form
                            id="quickAddForm"
                            onsubmit="quickAdd(event)"
                            class="space-y-4"
                        >
                            <input
                                type="text"
                                id="subject"
                                placeholder="Subject (e.g. Biology)"
                                class="w-full bg-zinc-800 border border-zinc-700 focus:border-indigo-500 rounded-2xl px-4 py-3 outline-none text-sm"
                            />

                            <input
                                type="text"
                                id="name"
                                placeholder="Assignment name"
                                class="w-full bg-zinc-800 border border-zinc-700 focus:border-indigo-500 rounded-2xl px-4 py-3 outline-none text-sm"
                            />

                            <div class="grid grid-cols-2 gap-3">
                                <div>
                                    <label
                                        class="text-xs text-zinc-400 block mb-1"
                                        >Due date</label
                                    >
                                    <input
                                        type="date"
                                        id="dueDate"
                                        class="w-full bg-zinc-800 border border-zinc-700 focus:border-indigo-500 rounded-2xl px-4 py-3 outline-none text-sm"
                                    />
                                </div>
                                <div>
                                    <label
                                        class="text-xs text-zinc-400 block mb-1"
                                        >Priority</label
                                    >
                                    <select
                                        id="priority"
                                        class="w-full bg-zinc-800 border border-zinc-700 focus:border-indigo-500 rounded-2xl px-4 py-3 outline-none text-sm"
                                    >
                                        <option value="High">🔴 High</option>
                                        <option value="Medium" selected>
                                            🟡 Medium
                                        </option>
                                        <option value="Low">🟢 Low</option>
                                    </select>
                                </div>
                            </div>

                            <button
                                type="submit"
                                class="w-full bg-indigo-600 hover:bg-indigo-500 transition-all active:scale-95 text-white font-medium py-3.5 rounded-2xl flex items-center justify-center gap-2"
                            >
                                <i class="fa-solid fa-plus"></i>
                                ADD ASSIGNMENT
                            </button>
                        </form>
                    </div>

                    <!-- Filters -->
                    <div class="bg-zinc-900 rounded-3xl p-6">
                        <h2 class="text-lg font-semibold mb-4">Filters</h2>
                        <div class="space-y-2">
                            <div
                                onclick="filterTasks('all')"
                                id="filter-all"
                                class="filter-btn active flex items-center gap-3 px-4 py-3 rounded-2xl cursor-pointer"
                            >
                                <i class="fa-solid fa-list"></i>
                                <span class="font-medium">All Assignments</span>
                                <span
                                    id="count-all"
                                    class="ml-auto text-xs bg-zinc-700 px-2.5 py-0.5 rounded-xl"
                                    >0</span
                                >
                            </div>
                            <div
                                onclick="filterTasks('pending')"
                                id="filter-pending"
                                class="filter-btn flex items-center gap-3 px-4 py-3 rounded-2xl cursor-pointer hover:bg-zinc-800"
                            >
                                <i class="fa-solid fa-clock"></i>
                                <span class="font-medium">Pending</span>
                                <span
                                    id="count-pending"
                                    class="ml-auto text-xs bg-amber-500/20 text-amber-400 px-2.5 py-0.5 rounded-xl"
                                    >0</span
                                >
                            </div>
                            <div
                                onclick="filterTasks('completed')"
                                id="filter-completed"
                                class="filter-btn flex items-center gap-3 px-4 py-3 rounded-2xl cursor-pointer hover:bg-zinc-800"
                            >
                                <i class="fa-solid fa-check-circle"></i>
                                <span class="font-medium">Completed</span>
                                <span
                                    id="count-completed"
                                    class="ml-auto text-xs bg-emerald-500/20 text-emerald-400 px-2.5 py-0.5 rounded-xl"
                                    >0</span
                                >
                            </div>
                            <div
                                onclick="filterTasks('overdue')"
                                id="filter-overdue"
                                class="filter-btn flex items-center gap-3 px-4 py-3 rounded-2xl cursor-pointer hover:bg-zinc-800"
                            >
                                <i class="fa-solid fa-fire"></i>
                                <span class="font-medium">Overdue</span>
                                <span
                                    id="count-overdue"
                                    class="ml-auto text-xs bg-red-500/20 text-red-400 px-2.5 py-0.5 rounded-xl"
                                    >0</span
                                >
                            </div>
                        </div>
                    </div>

                    <!-- Tip -->
                    <div
                        class="bg-gradient-to-br from-indigo-900/30 to-zinc-900 rounded-3xl p-6 text-sm"
                    >
                        <div class="flex gap-3">
                            <i
                                class="fa-solid fa-lightbulb text-2xl text-amber-400 mt-1"
                            ></i>
                            <div>
                                <p class="font-medium">Pro Tip</p>
                                <p
                                    class="text-zinc-400 text-xs mt-1 leading-relaxed"
                                >
                                    Click any assignment card to edit it.<br />
                                    Double-click the status to mark as done.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Main Content -->
                <div class="col-span-12 lg:col-span-9">
                    <div class="flex items-baseline justify-between mb-6">
                        <h2 id="view-title" class="text-2xl font-semibold">
                            All Assignments
                        </h2>
                        <div class="text-zinc-400 text-sm" id="total-tasks">
                            0 tasks
                        </div>
                    </div>

                    <!-- Task List -->
                    <div
                        id="task-list"
                        class="space-y-4 max-h-[calc(100vh-200px)] overflow-y-auto pr-2"
                    >
                        <!-- Tasks populated by JavaScript -->
                    </div>

                    <!-- Empty State -->
                    <div
                        id="empty-state"
                        class="hidden flex flex-col items-center justify-center py-24 text-center"
                    >
                        <div class="text-7xl mb-6">🎒</div>
                        <h3 class="text-2xl font-medium mb-2">
                            No assignments yet
                        </h3>
                        <p class="text-zinc-400 max-w-xs">
                            Add your school tasks using the form on the left
                            side.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Edit Modal -->
        <div
            id="edit-modal"
            class="hidden fixed inset-0 bg-black/70 flex items-center justify-center z-50 modal"
        >
            <div
                onclick="event.stopImmediatePropagation()"
                class="bg-zinc-900 rounded-3xl w-full max-w-md mx-4 p-8"
            >
                <h3 class="text-xl font-semibold mb-6">Edit Assignment</h3>

                <input type="hidden" id="edit-id" />

                <div class="space-y-5">
                    <div>
                        <label
                            class="text-xs uppercase tracking-widest text-zinc-400"
                            >Subject</label
                        >
                        <input
                            id="edit-subject"
                            type="text"
                            class="w-full bg-zinc-800 border border-zinc-700 rounded-2xl px-4 py-3 mt-1 focus:border-indigo-500 outline-none"
                        />
                    </div>
                    <div>
                        <label
                            class="text-xs uppercase tracking-widest text-zinc-400"
                            >Assignment Name</label
                        >
                        <input
                            id="edit-name"
                            type="text"
                            class="w-full bg-zinc-800 border border-zinc-700 rounded-2xl px-4 py-3 mt-1 focus:border-indigo-500 outline-none"
                        />
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label
                                class="text-xs uppercase tracking-widest text-zinc-400"
                                >Due Date</label
                            >
                            <input
                                id="edit-due"
                                type="date"
                                class="w-full bg-zinc-800 border border-zinc-700 rounded-2xl px-4 py-3 mt-1 focus:border-indigo-500 outline-none"
                            />
                        </div>
                        <div>
                            <label
                                class="text-xs uppercase tracking-widest text-zinc-400"
                                >Priority</label
                            >
                            <select
                                id="edit-priority"
                                class="w-full bg-zinc-800 border border-zinc-700 rounded-2xl px-4 py-3 mt-1 focus:border-indigo-500 outline-none"
                            >
                                <option value="High">🔴 High</option>
                                <option value="Medium">🟡 Medium</option>
                                <option value="Low">🟢 Low</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <label
                            class="text-xs uppercase tracking-widest text-zinc-400"
                            >Notes (optional)</label
                        >
                        <textarea
                            id="edit-notes"
                            rows="3"
                            class="w-full bg-zinc-800 border border-zinc-700 rounded-2xl px-4 py-3 mt-1 resize-none focus:border-indigo-500 outline-none"
                        ></textarea>
                    </div>

                    <div class="flex gap-3 pt-4">
                        <button
                            onclick="hideModal()"
                            class="flex-1 py-4 text-zinc-400 hover:bg-zinc-800 rounded-2xl font-medium transition-colors"
                        >
                            Cancel
                        </button>
                        <button
                            onclick="saveEdit()"
                            class="flex-1 py-4 bg-indigo-600 hover:bg-indigo-500 rounded-2xl font-medium transition-all active:scale-95"
                        >
                            Save Changes
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Stats Modal -->
        <div
            id="stats-modal"
            class="hidden fixed inset-0 bg-black/70 flex items-center justify-center z-50 modal"
        >
            <div
                onclick="event.stopImmediatePropagation()"
                class="bg-zinc-900 rounded-3xl w-full max-w-lg mx-4 p-8"
            >
                <h3 class="text-2xl font-semibold mb-8 flex items-center gap-3">
                    <i class="fa-solid fa-chart-pie"></i> Semester Progress
                </h3>

                <div class="grid grid-cols-3 gap-6 mb-10">
                    <div class="text-center">
                        <div
                            id="stat-completed-count"
                            class="text-5xl font-semibold text-emerald-400"
                        >
                            0
                        </div>
                        <div class="text-xs tracking-widest text-zinc-400 mt-2">
                            COMPLETED
                        </div>
                    </div>
                    <div class="text-center">
                        <div
                            id="stat-pending-count"
                            class="text-5xl font-semibold text-amber-400"
                        >
                            0
                        </div>
                        <div class="text-xs tracking-widest text-zinc-400 mt-2">
                            PENDING
                        </div>
                    </div>
                    <div class="text-center">
                        <div
                            id="stat-overdue-count"
                            class="text-5xl font-semibold text-red-400"
                        >
                            0
                        </div>
                        <div class="text-xs tracking-widest text-zinc-400 mt-2">
                            OVERDUE
                        </div>
                    </div>
                </div>

                <div class="bg-zinc-800 rounded-3xl p-6">
                    <div class="flex justify-between mb-3 text-sm">
                        <span>Overall Completion</span>
                        <span id="completion-rate" class="font-semibold"
                            >0%</span
                        >
                    </div>
                    <div class="h-3 bg-zinc-700 rounded-full overflow-hidden">
                        <div
                            id="completion-bar"
                            class="h-full bg-gradient-to-r from-emerald-400 to-indigo-500 rounded-full w-0 transition-all"
                        ></div>
                    </div>
                </div>

                <button
                    onclick="hideStats()"
                    class="mt-10 w-full py-4 bg-zinc-800 hover:bg-zinc-700 rounded-2xl font-medium transition-colors"
                >
                    Close Dashboard
                </button>
            </div>
        </div>

        <script>
            let tasks = [];
            let currentFilter = "all";

            function loadTasks() {
                const saved = localStorage.getItem("schoolAssignments");
                if (saved) {
                    tasks = JSON.parse(saved);
                } else {
                    // Demo data
                    tasks = [
                        {
                            id: 1,
                            subject: "Mathematics",
                            name: "Calculus Problem Set #4",
                            dueDate: "2026-04-28",
                            priority: "High",
                            status: "Pending",
                            notes: "Integration by parts",
                        },
                        {
                            id: 2,
                            subject: "English Literature",
                            name: "Essay on Macbeth",
                            dueDate: "2026-04-25",
                            priority: "Medium",
                            status: "Pending",
                            notes: "1500 words",
                        },
                        {
                            id: 3,
                            subject: "Biology",
                            name: "Cell Division Lab Report",
                            dueDate: "2026-04-22",
                            priority: "High",
                            status: "Completed",
                            notes: "",
                        },
                        {
                            id: 4,
                            subject: "History",
                            name: "Research on Philippine Revolution",
                            dueDate: "2026-04-20",
                            priority: "Low",
                            status: "Pending",
                            notes: "Include primary sources",
                        },
                    ];
                    saveTasks();
                }
                renderTasks();
            }

            function saveTasks() {
                localStorage.setItem(
                    "schoolAssignments",
                    JSON.stringify(tasks),
                );
            }

            function getSubjectEmoji(subject) {
                const s = subject.toLowerCase();
                if (s.includes("math")) return "📐";
                if (s.includes("bio")) return "🧬";
                if (s.includes("eng") || s.includes("literature")) return "📖";
                if (s.includes("hist")) return "🏛️";
                if (s.includes("phys")) return "⚡";
                if (s.includes("chem")) return "🧪";
                return "📚";
            }

            function getPriorityEmoji(p) {
                return p === "High" ? "🔴" : p === "Medium" ? "🟡" : "🟢";
            }

            function formatDueDate(dateStr) {
                const due = new Date(dateStr);
                if (isNaN(due)) return "No date";

                const now = new Date();
                const diffTime = due - now;
                const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));

                if (diffDays < 0)
                    return `<span class="text-red-400">Overdue by ${Math.abs(diffDays)} days</span>`;
                if (diffDays === 0)
                    return `<span class="text-amber-400">Due today!</span>`;
                if (diffDays === 1)
                    return `<span class="text-amber-400">Due tomorrow</span>`;
                return `In ${diffDays} days • ${due.toLocaleDateString("en-US", { month: "short", day: "numeric" })}`;
            }

            function renderTasks() {
                const container = document.getElementById("task-list");
                const empty = document.getElementById("empty-state");

                let filtered = tasks;

                if (currentFilter === "pending")
                    filtered = tasks.filter((t) => t.status === "Pending");
                else if (currentFilter === "completed")
                    filtered = tasks.filter((t) => t.status === "Completed");
                else if (currentFilter === "overdue") {
                    filtered = tasks.filter((t) => {
                        if (t.status === "Completed") return false;
                        return new Date(t.dueDate) < new Date();
                    });
                }

                // Update counts
                document.getElementById("count-all").textContent = tasks.length;
                document.getElementById("count-pending").textContent =
                    tasks.filter((t) => t.status === "Pending").length;
                document.getElementById("count-completed").textContent =
                    tasks.filter((t) => t.status === "Completed").length;
                document.getElementById("count-overdue").textContent =
                    tasks.filter(
                        (t) =>
                            t.status !== "Completed" &&
                            new Date(t.dueDate) < new Date(),
                    ).length;

                document.getElementById("total-tasks").textContent =
                    `${filtered.length} task${filtered.length !== 1 ? "s" : ""}`;

                container.innerHTML = "";

                if (filtered.length === 0) {
                    empty.classList.remove("hidden");
                    return;
                }
                empty.classList.add("hidden");

                // Sort by due date
                filtered.sort(
                    (a, b) => new Date(a.dueDate) - new Date(b.dueDate),
                );

                filtered.forEach((task) => {
                    const isOverdue =
                        task.status !== "Completed" &&
                        new Date(task.dueDate) < new Date();

                    const html = `
                <div onclick="editTask(${task.id})" class="task-card bg-zinc-900 border ${isOverdue ? "border-red-400/50" : "border-zinc-700"} rounded-3xl p-6 cursor-pointer hover:border-indigo-500/30">
                    <div class="flex items-start justify-between">
                        <div class="flex items-center gap-4">
                            <span class="text-3xl">${getSubjectEmoji(task.subject)}</span>
                            <div>
                                <div class="text-sm text-zinc-400">${task.subject}</div>
                                <h4 class="font-semibold text-lg leading-tight">${task.name}</h4>
                            </div>
                        </div>
                        
                        <div class="flex items-center gap-2">
                            <span onclick="event.stopImmediatePropagation(); toggleStatus(${task.id});" 
                                  class="px-4 py-1 text-xs font-medium rounded-3xl cursor-pointer ${
                                      task.status === "Completed"
                                          ? "bg-emerald-500/10 text-emerald-400"
                                          : "bg-amber-400/10 text-amber-400"
                                  }">
                                ${task.status === "Completed" ? "✅ Done" : "⏳ Pending"}
                            </span>
                            <span onclick="event.stopImmediatePropagation(); deleteTask(${task.id});" 
                                  class="w-9 h-9 flex items-center justify-center text-zinc-400 hover:text-red-400 hover:bg-red-400/10 rounded-2xl transition-colors">
                                <i class="fa-solid fa-trash"></i>
                            </span>
                        </div>
                    </div>

                    <div class="mt-5 flex items-center gap-6 text-sm">
                        <div class="flex items-center gap-2">
                            <i class="fa-solid fa-calendar text-zinc-400"></i>
                            <span>${formatDueDate(task.dueDate)}</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="text-xl">${getPriorityEmoji(task.priority)}</span>
                            <span class="text-zinc-400">${task.priority}</span>
                        </div>
                        ${task.notes ? `<div class="text-zinc-400 text-xs flex-1 truncate">📝 ${task.notes}</div>` : ""}
                    </div>
                </div>`;

                    container.innerHTML += html;
                });
            }

            function quickAdd(e) {
                e.preventDefault();

                const subject = document.getElementById("subject").value.trim();
                const name = document.getElementById("name").value.trim();
                const dueDate = document.getElementById("dueDate").value;
                const priority =
                    document.getElementById("priority").value || "Medium";

                if (!name || !subject) {
                    alert("Please fill in Subject and Assignment Name");
                    return;
                }

                const newTask = {
                    id: Date.now(),
                    subject: subject,
                    name: name,
                    dueDate: dueDate || "2026-05-01",
                    priority: priority,
                    status: "Pending",
                    notes: "",
                };

                tasks.unshift(newTask);
                saveTasks();
                renderTasks();

                document.getElementById("quickAddForm").reset();
            }

            function toggleStatus(id) {
                const task = tasks.find((t) => t.id === id);
                if (task) {
                    task.status =
                        task.status === "Completed" ? "Pending" : "Completed";
                    saveTasks();
                    renderTasks();
                }
            }

            function deleteTask(id) {
                if (confirm("Delete this assignment?")) {
                    tasks = tasks.filter((t) => t.id !== id);
                    saveTasks();
                    renderTasks();
                }
            }

            function editTask(id) {
                const task = tasks.find((t) => t.id === id);
                if (!task) return;

                document.getElementById("edit-id").value = task.id;
                document.getElementById("edit-subject").value = task.subject;
                document.getElementById("edit-name").value = task.name;
                document.getElementById("edit-due").value = task.dueDate;
                document.getElementById("edit-priority").value = task.priority;
                document.getElementById("edit-notes").value = task.notes || "";

                document
                    .getElementById("edit-modal")
                    .classList.remove("hidden");
                document.getElementById("edit-modal").classList.add("flex");
            }

            function saveEdit() {
                const id = parseInt(document.getElementById("edit-id").value);
                const task = tasks.find((t) => t.id === id);

                if (task) {
                    task.subject =
                        document.getElementById("edit-subject").value;
                    task.name = document.getElementById("edit-name").value;
                    task.dueDate = document.getElementById("edit-due").value;
                    task.priority =
                        document.getElementById("edit-priority").value;
                    task.notes = document
                        .getElementById("edit-notes")
                        .value.trim();
                }

                hideModal();
                saveTasks();
                renderTasks();
            }

            function hideModal() {
                const modal = document.getElementById("edit-modal");
                modal.classList.add("hidden");
                modal.classList.remove("flex");
            }

            function filterTasks(filter) {
                currentFilter = filter;

                document.querySelectorAll(".filter-btn").forEach((btn) => {
                    btn.classList.toggle(
                        "active",
                        btn.id === `filter-${filter}`,
                    );
                });

                const titles = {
                    all: "All Assignments",
                    pending: "Pending Assignments",
                    completed: "Completed Assignments",
                    overdue: "Overdue Assignments",
                };

                document.getElementById("view-title").textContent =
                    titles[filter] || "All Assignments";
                renderTasks();
            }

            function showStats() {
                const completed = tasks.filter(
                    (t) => t.status === "Completed",
                ).length;
                const pending = tasks.filter(
                    (t) => t.status === "Pending",
                ).length;
                const overdue = tasks.filter(
                    (t) =>
                        t.status !== "Completed" &&
                        new Date(t.dueDate) < new Date(),
                ).length;
                const total = completed + pending;
                const rate = total ? Math.round((completed / total) * 100) : 0;

                document.getElementById("stat-completed-count").textContent =
                    completed;
                document.getElementById("stat-pending-count").textContent =
                    pending;
                document.getElementById("stat-overdue-count").textContent =
                    overdue;
                document.getElementById("completion-rate").textContent =
                    rate + "%";
                document.getElementById("completion-bar").style.width =
                    rate + "%";

                document
                    .getElementById("stats-modal")
                    .classList.remove("hidden");
                document.getElementById("stats-modal").classList.add("flex");
            }

            function hideStats() {
                const modal = document.getElementById("stats-modal");
                modal.classList.add("hidden");
                modal.classList.remove("flex");
            }

            function exportData() {
                const dataStr = JSON.stringify(tasks, null, 2);
                const blob = new Blob([dataStr], { type: "application/json" });
                const url = URL.createObjectURL(blob);
                const a = document.createElement("a");
                a.href = url;
                a.download = "schoolflow-assignments.json";
                a.click();
                URL.revokeObjectURL(url);

                const toast = document.createElement("div");
                toast.innerHTML = "✅ Backup downloaded!";
                toast.style.cssText =
                    "position:fixed;bottom:30px;right:30px;background:#22c55e;color:white;padding:14px 24px;border-radius:9999px;font-weight:500;box-shadow:0 10px 15px -3px rgb(0 0 0 / 0.3);";
                document.body.appendChild(toast);
                setTimeout(() => toast.remove(), 2500);
            }

            function clearAllData() {
                if (confirm("Clear ALL assignments? This cannot be undone.")) {
                    localStorage.removeItem("schoolAssignments");
                    tasks = [];
                    renderTasks();
                }
            }

            // Initialize
            window.onload = () => {
                loadTasks();

                // Keyboard shortcut: "/" to focus quick add
                document.addEventListener("keydown", (e) => {
                    if (
                        e.key === "/" &&
                        document.activeElement.tagName === "BODY"
                    ) {
                        e.preventDefault();
                        document.getElementById("subject").focus();
                    }
                });
            };
        </script>
    </body>
</html>

