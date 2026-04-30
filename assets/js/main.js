document.addEventListener('DOMContentLoaded', function () {
  const nav = document.getElementById('siteNavigation');
  const overlay = document.getElementById('flyoutOverlay');
  const openBtn = document.querySelector('.menu-toggle');
  const closeBtn = document.querySelector('.close-flyout');
  const header = document.querySelector('.site-header');
  const mobileBreakpoint = window.matchMedia('(max-width: 1140px)');
  const focusableSelectors = 'a[href], button:not([disabled]), [tabindex]:not([tabindex="-1"])';

  let lastFocusedElement = null;
  let isKeyboardUser = false;

  function isMobileView() {
    return mobileBreakpoint.matches;
  }

  function hasMenuElements() {
    return nav && overlay && openBtn && closeBtn;
  }

  function getFocusableElements(container) {
    if (!container) return [];

    return Array.from(container.querySelectorAll(focusableSelectors)).filter(function (el) {
      return el.offsetParent !== null && !el.hasAttribute('inert');
    });
  }

  function createPlusMinusIcon(isExpanded) {
    return `
      <svg viewBox="0 0 24 24" aria-hidden="true" focusable="false">
        <line x1="5" y1="12" x2="19" y2="12"></line>
        ${!isExpanded ? '<line x1="12" y1="5" x2="12" y2="19"></line>' : ''}
      </svg>
    `;
  }

  function setSubmenuLinksTabIndex(submenu, value) {
    if (!submenu) return;

    submenu.querySelectorAll('a').forEach(function (link) {
      link.tabIndex = value;
    });
  }

  function openSubmenu(submenu, toggleBtn) {
    submenu.classList.add('open');
    submenu.style.maxHeight = submenu.scrollHeight + 'px';
    submenu.style.opacity = '1';
    setSubmenuLinksTabIndex(submenu, 0);

    if (toggleBtn) {
      toggleBtn.setAttribute('aria-expanded', 'true');
      toggleBtn.innerHTML = createPlusMinusIcon(true);
    }
  }

  function closeSubmenu(submenu, toggleBtn) {
    submenu.style.maxHeight = submenu.scrollHeight + 'px';

    requestAnimationFrame(function () {
      submenu.style.maxHeight = '0';
      submenu.style.opacity = '0';
    });

    setSubmenuLinksTabIndex(submenu, -1);

    if (toggleBtn) {
      toggleBtn.setAttribute('aria-expanded', 'false');
      toggleBtn.innerHTML = createPlusMinusIcon(false);
    }

    setTimeout(function () {
      submenu.classList.remove('open');
    }, 400);
  }

  function trapFocus(container) {
    const focusableElements = getFocusableElements(container);
    if (!focusableElements.length) return;

    const first = focusableElements[0];
    const last = focusableElements[focusableElements.length - 1];

    function handleKeydown(e) {
      if (e.key !== 'Tab') return;

      if (e.shiftKey && document.activeElement === first) {
        e.preventDefault();
        last.focus();
      } else if (!e.shiftKey && document.activeElement === last) {
        e.preventDefault();
        first.focus();
      }
    }

    releaseFocus(container);
    container.addEventListener('keydown', handleKeydown);
    container._trapListener = handleKeydown;
  }

  function releaseFocus(container) {
    if (!container || !container._trapListener) return;

    container.removeEventListener('keydown', container._trapListener);
    container._trapListener = null;
  }

  function handleEscapeGlobal(e) {
    if (e.key === 'Escape' && isMobileView() && nav && nav.classList.contains('open')) {
      closeMenu();
    }
  }

  function openMenu() {
    if (!hasMenuElements() || !isMobileView()) return;

    lastFocusedElement = document.activeElement;

    nav.classList.add('is-animating', 'open');
    nav.setAttribute('aria-hidden', 'false');

    overlay.classList.add('active');
    document.body.classList.add('no-scroll');
    openBtn.setAttribute('aria-expanded', 'true');

    trapFocus(nav);
    document.addEventListener('keydown', handleEscapeGlobal);

    const firstFocusable = getFocusableElements(nav)[0];
    if (firstFocusable) {
      firstFocusable.focus();
    }
  }

  function closeMenu() {
    if (!hasMenuElements()) return;

    nav.classList.add('is-animating');
    nav.classList.remove('open');
    nav.setAttribute('aria-hidden', 'true');

    overlay.classList.remove('active');
    document.body.classList.remove('no-scroll');
    openBtn.setAttribute('aria-expanded', 'false');

    releaseFocus(nav);
    document.removeEventListener('keydown', handleEscapeGlobal);

    if (isKeyboardUser && openBtn) {
      openBtn.focus();
      isKeyboardUser = false;
    } else if (lastFocusedElement && typeof lastFocusedElement.focus === 'function') {
      lastFocusedElement.focus();
    }
  }

  function removeMobileSubmenuToggles() {
    document.querySelectorAll('.submenu-toggle').forEach(function (btn) {
      btn.remove();
    });
  }

  function resetDesktopSubmenus() {
    document.querySelectorAll('.primary-menu .sub-menu').forEach(function (submenu) {
      submenu.classList.remove('open');
      submenu.style.maxHeight = '';
      submenu.style.opacity = '';

      submenu.querySelectorAll('a').forEach(function (link) {
        link.removeAttribute('tabindex');
      });
    });
  }

  function resetMobileSubmenus() {
    document.querySelectorAll('.primary-menu .sub-menu').forEach(function (submenu) {
      submenu.classList.remove('open');
      submenu.style.maxHeight = '0';
      submenu.style.opacity = '0';
      setSubmenuLinksTabIndex(submenu, -1);
    });

    document.querySelectorAll('.submenu-toggle').forEach(function (btn) {
      btn.setAttribute('aria-expanded', 'false');
      btn.innerHTML = createPlusMinusIcon(false);
    });
  }

  function resetDesktopState() {
    if (!hasMenuElements()) return;

    nav.classList.add('no-transition');
    nav.classList.remove('open', 'is-animating');
    nav.setAttribute('aria-hidden', 'false');

    overlay.classList.remove('active');
    document.body.classList.remove('no-scroll');
    openBtn.setAttribute('aria-expanded', 'false');

    releaseFocus(nav);
    document.removeEventListener('keydown', handleEscapeGlobal);

    removeMobileSubmenuToggles();
    resetDesktopSubmenus();

    requestAnimationFrame(function () {
      requestAnimationFrame(function () {
        nav.classList.remove('no-transition');
      });
    });
  }

  function buildMobileSubmenuToggles() {
    if (!isMobileView()) return;

    document.querySelectorAll('.primary-menu .menu-item-has-children').forEach(function (item, index) {
      const submenu = item.querySelector(':scope > .sub-menu');
      if (!submenu) return;

      const existingToggle = item.querySelector(':scope > .submenu-toggle');
      if (existingToggle) return;

      const submenuId = submenu.id || `submenu-${index}`;
      submenu.id = submenuId;
      submenu.style.maxHeight = '0';
      submenu.style.opacity = '0';
      setSubmenuLinksTabIndex(submenu, -1);

      const parentLink = item.querySelector(':scope > a');
      const parentLinkText = parentLink ? parentLink.textContent.trim() : 'submenu';

      const toggleBtn = document.createElement('button');
      toggleBtn.className = 'submenu-toggle';
      toggleBtn.type = 'button';
      toggleBtn.setAttribute('aria-controls', submenuId);
      toggleBtn.setAttribute('aria-expanded', 'false');
      toggleBtn.innerHTML = createPlusMinusIcon(false);

      toggleBtn.addEventListener('click', function () {
        const isOpen = submenu.classList.contains('open');

        if (isOpen) {
          closeSubmenu(submenu, toggleBtn);
        } else {
          openSubmenu(submenu, toggleBtn);
        }
      });

      item.insertBefore(toggleBtn, submenu);
    });
  }

  function handleViewportChange() {
    if (!hasMenuElements()) return;

    nav.classList.add('no-transition');
    nav.classList.remove('open', 'is-animating');
    overlay.classList.remove('active');

    document.body.classList.remove('no-scroll');
    openBtn.setAttribute('aria-expanded', 'false');

    releaseFocus(nav);
    document.removeEventListener('keydown', handleEscapeGlobal);

    if (isMobileView()) {
      nav.setAttribute('aria-hidden', 'true');
      buildMobileSubmenuToggles();
      resetMobileSubmenus();
    } else {
      resetDesktopState();
    }

    requestAnimationFrame(function () {
      requestAnimationFrame(function () {
        nav.classList.remove('no-transition');
      });
    });
  }

  function initMenuEvents() {
    if (!hasMenuElements()) return;

    openBtn.addEventListener('click', openMenu);
    closeBtn.addEventListener('click', closeMenu);
    overlay.addEventListener('click', closeMenu);

    handleViewportChange();
    mobileBreakpoint.addEventListener('change', handleViewportChange);
  }

  function initHeaderScroll() {
    if (!header) return;

    const scrollThreshold = 10;

    window.addEventListener('scroll', function () {
      header.classList.toggle('scrolled', window.scrollY > scrollThreshold);
    });
  }

  window.addEventListener('keydown', function (e) {
    if (e.key === 'Tab' || e.key === 'Escape') {
      isKeyboardUser = true;
    }
  });

  window.addEventListener('mousedown', function () {
    isKeyboardUser = false;
  });

  initMenuEvents();
  initHeaderScroll();
});
