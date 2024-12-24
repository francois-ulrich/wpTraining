/**
 * WordPress dependencies
 */
import { store, getContext } from "@wordpress/interactivity";

type ServerState = {
  state: {
    // isDark: boolean;
    // darkText: string;
    // lightText: string;

    skyColor: string;
    grassColor: string;
  };
};

// type Context = {
//   isOpen: boolean;
// };

interface Store {
  state: {};
  actions: {};
  callbacks: {
    logChange: () => void;
  };
}

// const storeDef = {
//   state: {
//     get themeText(): string {
//       return state.isDark ? state.darkText : state.lightText;
//     },
//   },
//   actions: {
//     toggleOpen() {
//       const context = getContext<Context>();
//       context.isOpen = !context.isOpen;
//     },
//     toggleTheme() {
//       state.isDark = !state.isDark;
//     },
//   },
//   callbacks: {
//     logIsOpen: () => {
//       const { isOpen } = getContext<Context>();
//       // Log the value of `isOpen` each time it changes.
//       console.log(`Is open: ${isOpen}`);
//     },
//   },
// };

const storeDef: Store = {
  state: {},
  actions: {},
  callbacks: {
    logChange: () => {
      console.log("change");
    },
  },
};

const { state } = store<ServerState & Store>("quiz-block", storeDef);
