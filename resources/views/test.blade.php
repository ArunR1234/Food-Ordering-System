<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Arun R — Laravel Developer | MCA Student</title>
  <meta name="description" content="Arun R — Laravel Developer | MCA Student. Backend specialist building scalable web apps." />
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    html { scroll-behavior: smooth; }
    :target::before { content: ""; display: block; height: 80px; margin-top: -80px; }

    /* Fade-in animation for sections */
    @keyframes fadeInUp {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }
    section {
      animation: fadeInUp 0.8s ease both;
    }

    /* Glow hover for main buttons */
    .btn-glow:hover {
      box-shadow: 0 0 15px rgba(99,102,241,0.6);
      transform: scale(1.05);
      transition: all 0.2s ease-in-out;
    }

    /* Hero gradient background */
    .hero-gradient {
      background: radial-gradient(circle at top left, rgba(99,102,241,0.15), rgba(0,0,0,0.8));
    }

    /* Scroll to top button */
    #toTopBtn {
      position: fixed;
      bottom: 30px;
      right: 30px;
      background: linear-gradient(135deg, #6366f1, #a855f7);
      color: white;
      padding: 10px 14px;
      border-radius: 50%;
      font-size: 20px;
      display: none;
      box-shadow: 0 0 10px rgba(99,102,241,0.6);
      transition: all 0.3s ease;
      z-index: 50;
    }
    #toTopBtn:hover {
      transform: translateY(-4px);
      box-shadow: 0 0 20px rgba(99,102,241,0.8);
    }
  </style>
</head>
<body class="bg-gray-950 text-gray-200 antialiased">

  <!-- NAV -->
  <header class="fixed top-0 left-0 right-0 bg-gray-900/80 backdrop-blur z-40">
    <div class="max-w-5xl mx-auto flex items-center justify-between px-4 py-3">
      <a href="#home" class="flex items-center gap-2">
        <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-indigo-500 to-purple-500 flex items-center justify-center text-white font-bold">AR</div>
        <div class="hidden sm:block">
          <div class="text-white font-semibold">Arun R</div>
          <div class="text-xs text-gray-400">Laravel Developer | MCA Student</div>
        </div>
      </a>

      <nav class="hidden md:flex items-center gap-6 text-sm">
        <a href="#about" class="hover:text-indigo-400">About</a>
        <a href="#skills" class="hover:text-indigo-400">Skills</a>
        <a href="#projects" class="hover:text-indigo-400">Projects</a>
        <a href="#resume" class="hover:text-indigo-400">Resume</a>
        <a href="#contact" class="hover:text-indigo-400">Contact</a>
      </nav>

      <div class="md:hidden">
        <button id="menuBtn" class="p-2 rounded-md border border-gray-800">Menu</button>
      </div>
    </div>

    <!-- Mobile menu -->
    <div id="mobileMenu" class="hidden md:hidden bg-gray-900 border-t border-gray-800">
      <div class="flex flex-col px-4 py-3 gap-2">
        <a href="#about" class="hover:text-indigo-400">About</a>
        <a href="#skills" class="hover:text-indigo-400">Skills</a>
        <a href="#projects" class="hover:text-indigo-400">Projects</a>
        <a href="#resume" class="hover:text-indigo-400">Resume</a>
        <a href="#contact" class="hover:text-indigo-400">Contact</a>
      </div>
    </div>
  </header>

  <!-- HERO -->
  <main class="pt-24">
    <section id="home" class="min-h-screen flex items-center hero-gradient">
      <div class="max-w-5xl mx-auto px-4 py-20 grid md:grid-cols-2 gap-8 items-center">
        <div>
          <h1 class="text-4xl md:text-6xl font-extrabold leading-tight">Hi, I'm <span class="text-indigo-400">Arun R</span> 👋</h1>
          <p class="mt-4 text-gray-300 text-lg md:text-xl">Laravel Developer | MCA Student — Backend specialist building scalable web applications and APIs.</p>

          <div class="mt-8 flex flex-wrap gap-3">
            <a href="#projects" class="inline-block bg-indigo-500 text-black font-semibold px-5 py-3 rounded-lg shadow btn-glow">View Projects</a>
            <a href="#contact" class="inline-block border border-indigo-400 px-5 py-3 rounded-lg hover:bg-indigo-400 hover:text-black btn-glow">Contact Me</a>
            <a href="#resume" class="inline-block text-sm px-4 py-3 rounded-lg bg-gray-800 border border-gray-700 hover:bg-gray-800/90">Download Resume</a>
          </div>

          <div class="mt-8 flex flex-wrap gap-4 text-sm text-gray-400">
            <div class="flex items-center gap-2"><span class="text-indigo-400">📍</span> Chennai, India</div>
            <div class="flex items-center gap-2"><span class="text-indigo-400">💼</span> RSoft Technologies</div>
            <div class="flex items-center gap-2"><span class="text-indigo-400">✉️</span> <a href="mailto:arun16official@gmail.com" class="text-gray-200 hover:underline">arun16official@gmail.com</a></div>
          </div>
        </div>

        <div class="order-first md:order-last">
          <div class="w-full rounded-2xl border border-gray-800 p-6 bg-gradient-to-br from-gray-900/60 to-gray-800/40">
            <h3 class="text-white font-semibold mb-4">Quick Bio</h3>
            <p class="text-gray-300 leading-relaxed">
              Fresh BCA graduate, currently pursuing MCA and working as a Laravel Developer at RSoft Technologies.
              I focus on backend systems, RESTful APIs, database optimization, and building maintainable code.
            </p>

            <div class="mt-6 grid grid-cols-2 gap-3 text-xs">
              <div class="p-3 bg-gray-900 rounded-lg border border-gray-800">
                <div class="text-gray-400">Experience</div>
                <div class="text-white font-semibold">Fresher (Working)</div>
              </div>
              <div class="p-3 bg-gray-900 rounded-lg border border-gray-800">
                <div class="text-gray-400">Goal</div>
                <div class="text-white font-semibold">Senior Developer</div>
              </div>
              <div class="p-3 bg-gray-900 rounded-lg border border-gray-800">
                <div class="text-gray-400">Tech</div>
                <div class="text-white font-semibold">Laravel, PHP, MySQL</div>
              </div>
              <div class="p-3 bg-gray-900 rounded-lg border border-gray-800">
                <div class="text-gray-400">Learning</div>
                <div class="text-white font-semibold">Vue / React, DevOps</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- ABOUT -->
    <section id="about" class="py-16 border-t border-gray-800">
      <div class="max-w-4xl mx-auto px-4 text-center">
        <h2 class="text-3xl font-bold text-indigo-400">About Me</h2>
        <p class="mt-4 text-gray-300">I’m Arun R, a Laravel Developer from Chennai. I build backend systems, APIs, and maintain scalable applications. I'm balancing real work at RSoft with my MCA studies to grow both practical and theoretical skills.</p>
      </div>
    </section>

    <!-- SKILLS -->
    <section id="skills" class="py-16">
      <div class="max-w-5xl mx-auto px-4">
        <h2 class="text-3xl font-bold text-indigo-400 text-center">Skills</h2>

        <div class="mt-8 grid md:grid-cols-3 gap-6">
          <div class="p-6 bg-gray-900 rounded-2xl border border-gray-800">
            <h3 class="font-semibold text-white">Backend</h3>
            <p class="mt-2 text-gray-300">Laravel, PHP 8+, RESTful APIs, Eloquent ORM, Authentication (Sanctum)</p>
          </div>
          <div class="p-6 bg-gray-900 rounded-2xl border border-gray-800">
            <h3 class="font-semibold text-white">Frontend</h3>
            <p class="mt-2 text-gray-300">Blade templates, TailwindCSS, basic Vue/React integration</p>
          </div>
          <div class="p-6 bg-gray-900 rounded-2xl border border-gray-800">
            <h3 class="font-semibold text-white">Database & Tools</h3>
            <p class="mt-2 text-gray-300">MySQL, Indexing, Redis (caching basics), Git, Postman, VSCode</p>
          </div>
        </div>

        <div class="mt-8">
          <h4 class="text-sm text-gray-400">Proficiency</h4>
          <div class="mt-3 space-y-3">
            <div>
              <div class="flex justify-between text-xs text-gray-400"><span>Laravel</span><span>80%</span></div>
              <div class="h-2 bg-gray-800 rounded-full mt-1"><div class="h-2 rounded-full transition-all duration-700" style="width:80%; background:linear-gradient(90deg,#7c3aed,#4f46e5)"></div></div>
            </div>
            <div>
              <div class="flex justify-between text-xs text-gray-400"><span>PHP</span><span>75%</span></div>
              <div class="h-2 bg-gray-800 rounded-full mt-1"><div class="h-2 rounded-full transition-all duration-700" style="width:75%; background:linear-gradient(90deg,#06b6d4,#7c3aed)"></div></div>
            </div>
            <div>
              <div class="flex justify-between text-xs text-gray-400"><span>Frontend (Blade/Tailwind)</span><span>55%</span></div>
              <div class="h-2 bg-gray-800 rounded-full mt-1"><div class="h-2 rounded-full transition-all duration-700" style="width:55%; background:linear-gradient(90deg,#ef4444,#f97316)"></div></div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- PROJECTS -->
    <section id="projects" class="py-16 border-t border-gray-800">
      <div class="max-w-6xl mx-auto px-4">
        <h2 class="text-3xl font-bold text-indigo-400 text-center">Projects</h2>
        <p class="text-center text-gray-400 mt-2">Sample projects — replace with your own repos and live links.</p>

        <div class="mt-8 grid md:grid-cols-3 gap-6">
          <!-- Project Cards -->
          <article class="bg-gray-900 p-6 rounded-2xl border border-gray-800 hover:-translate-y-1 hover:shadow-lg hover:shadow-indigo-500/10 transition">
            <div class="flex items-start justify-between">
              <h3 class="font-semibold text-white">🛒 E-commerce Backend</h3>
              <span class="text-xs text-gray-400">Laravel, MySQL, Sanctum</span>
            </div>
            <p class="mt-3 text-gray-300 text-sm">A modular backend for managing products, orders, users, and admin roles. Includes payment flow (mock), product search, and order history APIs.</p>
            <div class="mt-4 flex items-center gap-3">
              <a href="#" class="text-indigo-400 text-sm hover:underline">GitHub</a>
              <a href="#" class="text-gray-400 text-sm">Live</a>
            </div>
          </article>

          <article class="bg-gray-900 p-6 rounded-2xl border border-gray-800 hover:-translate-y-1 hover:shadow-lg hover:shadow-indigo-500/10 transition">
            <div class="flex items-start justify-between">
              <h3 class="font-semibold text-white">🎓 Student Management System</h3>
              <span class="text-xs text-gray-400">Laravel, Blade</span>
            </div>
            <p class="mt-3 text-gray-300 text-sm">CRUD system for students, teachers, subjects, and marks. Demonstrates relationships, validations, and simple role-based access.</p>
            <div class="mt-4 flex items-center gap-3">
              <a href="#" class="text-indigo-400 text-sm hover:underline">GitHub</a>
              <a href="#" class="text-gray-400 text-sm">Live</a>
            </div>
          </article>

          <article class="bg-gray-900 p-6 rounded-2xl border border-gray-800 hover:-translate-y-1 hover:shadow-lg hover:shadow-indigo-500/10 transition">
            <div class="flex items-start justify-between">
              <h3 class="font-semibold text-white">🧩 Task Manager API</h3>
              <span class="text-xs text-gray-400">Laravel, Sanctum, Postman</span>
            </div>
            <p class="mt-3 text-gray-300 text-sm">RESTful API for user auth, task CRUD, and deadline reminders using queued jobs and notifications.</p>
            <div class="mt-4 flex items-center gap-3">
              <a href="#" class="text-indigo-400 text-sm hover:underline">GitHub</a>
              <a href="#" class="text-gray-400 text-sm">Live</a>
            </div>
          </article>
        </div>

        <div class="mt-8 text-center">
          <a href="#" class="inline-block px-6 py-3 rounded-lg border border-indigo-400 text-indigo-400 hover:bg-indigo-400 hover:text-black btn-glow">See more on GitHub</a>
        </div>
      </div>
    </section>

    <!-- RESUME -->
    <section id="resume" class="py-16">
      <div class="max-w-4xl mx-auto px-4 text-center">
        <h2 class="text-3xl font-bold text-indigo-400">Resume</h2>
        <p class="mt-3 text-gray-400">Download my resume (PDF) to view detailed experience and education.</p>
        <div class="mt-6 flex items-center justify-center gap-4">
          <a href="resume.pdf" download class="bg-indigo-500 text-black px-6 py-3 rounded-lg font-semibold btn-glow">Download Resume</a>
          <a href="#" class="border border-gray-700 px-6 py-3 rounded-lg hover:bg-gray-800">View Online</a>
        </div>
      </div>
    </section>

    <!-- CONTACT -->
    <section id="contact" class="py-16 border-t border-gray-800">
      <div class="max-w-3xl mx-auto px-4 text-center">
        <h2 class="text-3xl font-bold text-indigo-400">Contact</h2>
        <p class="mt-3 text-gray-400">Want to collaborate or have a job opportunity? Send me a message — or email directly at <a href="mailto:arun16official@gmail.com" class="text-indigo-300 hover:underline">arun16official@gmail.com</a>.</p>

        <form id="contactForm" class="mt-8 grid gap-4">
          <input name="name" type="text" placeholder="Your name" required class="w-full p-3 rounded-lg bg-gray-900 border border-gray-800"/>
          <input name="email" type="email" placeholder="Your email" required class="w-full p-3 rounded-lg bg-gray-900 border border-gray-800"/>
          <textarea name="message" rows="5" placeholder="Message" required class="w-full p-3 rounded-lg bg-gray-900 border border-gray-800"></textarea>
          <div class="flex justify-center">
            <button type="submit" class="bg-indigo-500 px-6 py-3 rounded-lg font-semibold btn-glow">Send Message</button>
          </div>
          <p id="formNotice" class="text-sm text-gray-400 hidden mt-2">This is a static demo form. Replace with a backend or form service to receive messages.</p>
        </form>

        <div class="mt-6 flex items-center justify-center gap-4 text-gray-400">
          <a href="https://github.com/" id="githubLink" class="hover:text-indigo-400">💻 GitHub</a>
          <a href="https://linkedin.com/" id="linkedinLink" class="hover:text-indigo-400">💼 LinkedIn</a>
        </div>
      </div>
    </section>
  </main>

  <!-- FOOTER -->
  <footer class="border-t border-gray-800 mt-12">
    <div class="max-w-5xl mx-auto px-4 py-8 text-center text-sm text-gray-500">
      © 2025 Arun R — Laravel Developer. Built with ❤️ using TailwindCSS.
    </div>
  </footer>

  <!-- Scroll to top -->
  <button id="toTopBtn">↑</button>

  <script>
    // Mobile menu
    const menuBtn = document.getElementById('menuBtn');
    const mobileMenu = document.getElementById('mobileMenu');
    menuBtn.addEventListener('click', () => mobileMenu.classList.toggle('hidden'));

    // Scroll to top
    const toTopBtn = document.getElementById('toTopBtn');
    window.addEventListener('scroll', () => {
      if (window.scrollY > 300) toTopBtn.style.display = 'block';
      else toTopBtn.style.display = 'none';
    });
    toTopBtn.addEventListener('click', () => window.scrollTo({top:0, behavior:'smooth'}));

    // Contact form
    document.getElementById('contactForm').addEventListener('submit', e => {
      e.preventDefault();
      document.getElementById('formNotice').classList.remove('hidden');
      e.target.reset();
    });
  </script>
</body>
</html>
