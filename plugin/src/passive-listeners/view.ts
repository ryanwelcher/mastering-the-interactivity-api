/**
 * WordPress dependencies
 */
import { store } from '@wordpress/interactivity';

type ServerState = {
	state: {
		once: boolean;
		primes: string;
	};
};

type Context = {
	isOpen: boolean;
};

const storeDef = {
	state: {},
	actions: {
		wheelHandler: () => {
			if ( ! state.once ) {
				state.once = true;

				function isPrime( n: number ) {
					for ( let c = 2; c <= Math.sqrt( n ); ++c ) {
						if ( n % c === 0 ) {
							return false;
						}
					}
					return true;
				}

				const quota = 1000000;
				const primes = [];
				const maximum = 1000000;

				while ( primes.length < quota ) {
					const candidate = Math.floor(
						Math.random() * ( maximum + 1 )
					);
					if ( isPrime( candidate ) ) {
						primes.push( candidate );
					}
				}
				state.primes = primes.length.toString();
			}
		},
	},
	callbacks: {},
};

type Store = ServerState & typeof storeDef;

const { state } = store< Store >( 'passive-listeners', storeDef );
