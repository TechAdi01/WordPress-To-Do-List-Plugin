# ✅ CheckItOf – WordPress To-Do List Plugin

CheckItOf is a simple and lightweight to-do list plugin for WordPress. It allows users to add, complete, and manage tasks directly from a WordPress page using a shortcode. Built with PHP, JavaScript (AJAX), HTML, and CSS – it's designed to be a practical beginner WordPress plugin project.

## 🔧 Features

- Add new tasks
- Mark tasks as completed
- Clean and minimal user interface
- AJAX-based task handling (no page reloads)
- Shortcode support: `[checkitof]`
- Easy to install and use

---

## 📷 Demo

> **Live Demo:** [https://your-demo-link.com](https://your-demo-link.com)

---

## 🚀 Installation

1. Download the plugin ZIP or clone the repo:
   ```bash
   git clone https://github.com/yourusername/checkitof.git
   
2. Upload the folder to your WordPress site under:
   ```bash
   /wp-content/plugins/checkitof

3. Activate the plugin from the WordPress admin dashboard.

4. Add the shortcode [checkitof] to any page or post.

#🛠️ How It Works
``
      -The plugin registers a shortcode that loads a simple HTML task interface.
      -JavaScript (AJAX) handles task submission without refreshing the page.
      -Tasks are stored in the WordPress database using the options table.
      -You can modify styles and extend functionality (e.g., due dates, persistent user tasks, etc.)

##📁 Plugin File Structure
 ```bash
  checkitof/
├── checkitof.php        # Main plugin file
├── style.css            # Custom styles for to-do list
├── script.js            # AJAX interactions
└── templates/
    └── todo-list.php    # UI markup (loaded via shortcode)
```
-- 
##🧠Technologies Used

- PHP (WordPress Hooks & Options API)
- JavaScript (jQuery & AJAX)
- HTML5 & CSS3
- WordPress Shortcodes
- WordPress Plugin Architecture

--

##🤝 Contributions

Pull requests and ideas are welcome. This project is open for learning and collaboration.



