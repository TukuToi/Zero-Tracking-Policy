<?php
/**
 * Implements the Zero Tracking Policy Class.
 *
 * @package Zero_Tracking_Policy
 * @since 1.0.0
 */

/**
 * Class to implement the Zero Tracking Policy Blockchain.
 *
 * @since 1.0.0
 */
class Zero_Tracking_Policy {

	/**
	 * The chain of verified sites
	 *
	 * @var array chain The array of verified sites.
	 */
	private $chain;

	/**
	 * The nodes of the network
	 *
	 * @var array nodes The nodes of the Zero Tracking Policy Network.
	 */
	private $nodes;

	/**
	 * The pending domains of the chain
	 *
	 * @var array pending_domains The domains pending.
	 */
	private $pending_domains;

	/**
	 * The verified domains of the chain
	 *
	 * @var array domains The domains verified.
	 */
	private $domains;

	/**
	 * The genesis domain.
	 *
	 * @var string $genesis_domain The genesis Domain from which all started.
	 */
	private $genesis_domain = 'zero-tracking-policy.com';

	/**
	 * The path to the chain.
	 *
	 * @var string $chain_path The path to the chain .json file.
	 */
	private $chain_path = 'data/chain.json';

	/**
	 * The path to the nodes.
	 *
	 * @var string $nodes_path The path to the nodes .json file.
	 */
	private $nodes_path = 'data/nodes.json';

	/**
	 * The path to domains.
	 *
	 * @var string $domains_path The path to the domains .json file.
	 */
	private $domains_path = 'data/domains.json';

	/**
	 * The path to pending domains.
	 *
	 * @var string $pending_domains_path The path to the pending domains .json file.
	 */
	private $pending_domains_path = 'data/pending_domains.json';

	/**
	 * The path to API file.
	 *
	 * @var string $api_path The path to the pending domains .json file.
	 */
	private $api_path = '/zero_tracking_policy/v1.php';


	/**
	 * Initialise the Policy.
	 */
	public function __construct() {

		$this->chain = self::get_chain();
		$this->nodes = self::get_nodes();
		$this->pending_domains = self::get_pending_domains();
		$this->domains = self::get_domains();

	}

	/**
	 * Get the chain.
	 *
	 * @return array $chain The chain of this node.
	 */
	protected function get_chain() {

		$chain = file_get_contents( $this->chain_path );

		if ( ! empty( $chain ) ) {
			$chain = json_decode( $chain );
		} else {
			$chain = array( $this->genesis_block() );
			file_put_contents( $this->chain_path, json_encode( $chain ) );
			file_put_contents( $this->domains_path, json_encode( array( $this->genesis_domain ) ) );
		}

		return $chain;

	}

	/**
	 * Get the nodes.
	 *
	 * @return array $nodes The nodes of the network.
	 */
	protected function get_nodes() {

		$nodes = file_get_contents( $this->nodes_path );

		if ( ! empty( $nodes ) ) {
			$nodes = json_decode( $nodes );
		} else {
			$nodes = array( $_SERVER['HTTP_HOST'] );
			file_put_contents( $this->nodes_path, json_encode( $nodes ) );
		}

		return $nodes;

	}

	/**
	 * Generate a genesis block.
	 */
	private function genesis_block() {

		$genesis_block = array(
			'index' => 0,
			'timestamp' => time(),
			'proof' => 0,
			'previous_hash' => 0,
			'domain' => $this->genesis_domain,
			'confirmations' => 0,
		);

		return $genesis_block;

	}

	/**
	 * Get pending domains.
	 */
	private function get_pending_domains() {

		$pending_domains = file_get_contents( $this->pending_domains_path );

		if ( ! empty( $pending_domains ) ) {
			$pending_domains = json_decode( $pending_domains );
		} else {
			$pending_domains = array();
		}

		return $pending_domains;

	}

	/**
	 * Get verified domains.
	 */
	private function get_domains() {

		$domains = file_get_contents( $this->domains_path );

		if ( ! empty( $domains ) ) {
			$domains = json_decode( $domains );
		} else {
			$domains = array();
		}

		return $domains;

	}

	/**
	 * Stage a domain
	 *
	 * @param string $domain The domain to add.
	 */
	protected function stage_domain( string $domain ) {

		if ( ! in_array( $domain, $this->pending_domains )
			&& ! in_array( $domain, $this->domains )
		) {
			$this->pending_domains[] = $domain;
			file_put_contents( $this->pending_domains_path, json_encode( $this->pending_domains ) );
			$added = true;
		} else {
			$added = false;
		}

		return $added;

	}

	/**
	 * Verify a site
	 *
	 * @param int    $proof The proof of verification.
	 * @param string $previous_hash The previous verification hash.
	 * @param string $domain The domain.
	 * @param int    $confirmations The domain.
	 * @return array $verified_domain The verified Site.
	 */
	private function add_domain( int $proof, string $previous_hash, string $domain, int $confirmations ) {

		$verified_domain = array(
			'index' => count( $this->chain ) + 1,
			'timestamp' => time(),
			'proof' => $proof,
			'previous_hash' => $previous_hash,
			'domain' => $domain,
			'confirmations' => $confirmations + 1,
		);

		$this->chain[] = $verified_domain;
		$this->domains[] = $domain;
		$cleared = array_diff( $this->pending_domains, array( $domain ) );
		$this->pending_domains = empty( $cleared ) ? '' : json_encode( $cleared );
		file_put_contents( $this->chain_path, json_encode( $this->chain ) );
		if ( ! in_array( $domain, $this->get_domains() ) ) {
			file_put_contents( $this->domains_path, json_encode( $this->domains ) );
		}
		file_put_contents( $this->pending_domains_path, $this->pending_domains );

		return $verified_domain;

	}

	/**
	 * Verify a domain.
	 *
	 * @param string $domain The domain to verify.
	 */
	protected function verify_domain( $domain ) {

		$verified_domain = $this->get_any_verified_domain( $domain );
		$confirmations = $verified_domain->confirmations;
		$previous_block = $this->get_previous_verified_domain();
		$previous_proof = $previous_block->proof;
		$proof = $this->proof_of_verification( $previous_proof );
		$previous_hash = $this->hash( $previous_block );
		$block = $this->add_domain( $proof, strval( $previous_hash ), $domain, $confirmations );

		return $block;
	}

	/**
	 * Get a domain block.
	 *
	 * @param string $domain The domain of which to get the (latest) block.
	 */
	protected function get_domain( $domain ) {

		return array( $this->get_any_verified_domain( $domain ) );

	}

	/**
	 * Return any verified site.
	 *
	 * @param string $domain The domain to get the block of.
	 * @return array $last_verified_site The last verified site.
	 */
	private function get_any_verified_domain( $domain ) {

		$block = new stdClass();
		$index = $this->get_verified_domain_index( $domain );

		if ( false !== $index ) {
			return $this->chain[ $index ];
		} else {
			$block->confirmations = false;
			return $block;
		}

	}

	/**
	 * Get index of domain block in chain.
	 *
	 * @param string $domain The domain of which to get the index in the chain.
	 * @return int $index The index of the block in the chain.
	 */
	private function get_verified_domain_index( $domain ) {

		$index = array_search( $domain, array_reverse( array_column( $this->chain, 'domain' ), true ) );

		return $index;

	}

	/**
	 * Return last verified site.
	 *
	 * @return array $last_verified_site The last verified site.
	 */
	private function get_previous_verified_domain() {

		$last_verified_site = end( $this->chain );

		return $last_verified_site;

	}

	/**
	 * Return proof of verification
	 *
	 * @param int $previous_proof The previous proof of verification.
	 * @return int $new_proof The new proof of verification.
	 */
	private function proof_of_verification( $previous_proof ) {

		$new_proof = 1;
		$check_proof = false;

		while ( false === $check_proof ) {

			$hash = hash( 'sha256', ( pow( $new_proof, 2 ) - pow( $previous_proof, 2 ) ) );
			if ( '0000' === substr( $hash, 0, 4 ) ) {
				$check_proof = true;
			} else {
				++$new_proof;
			}
		}

		return $new_proof;

	}

	/**
	 * Return hash of verified site.
	 *
	 * @param array $verified_site The verified site.
	 * @return $hash Hash of verified site.
	 */
	private function hash( $verified_site ) {

		$json = json_encode( $verified_site );
		$hash = hash( 'sha256', json_encode( $verified_site ) );
		return $hash;

	}

	/**
	 * Check if chain of verifications is valid.
	 *
	 * @param array $chain The chain array.
	 * @return bool If the chain is valid.
	 */
	protected function is_chain_valid( $chain = false ) {

		$chain = false === $chain ? $this->chain : $chain;
		$previous_verification = $chain[0];
		$index = 1;
		$count = count( $chain );

		while ( $index < $count ) {
			$verification = $chain[ $index ];
			if ( $verification->previous_hash !== $this->hash( $previous_verification ) ) {
				return false;
			}
			$previous_proof = $previous_verification->proof;
			$verification_proof = $verification->proof;
			$hash = hash( 'sha256', ( pow( $verification_proof, 2 ) - pow( $previous_proof, 2 ) ) );
			if ( '0000' !== substr( $hash, 0, 4 ) ) {
				$check_proof = false;
			}
			$previous_verification = $verification;
			++$index;
		}

		return true;

	}

	/**
	 * Add a node
	 *
	 * @param string $address the remote node address.
	 * @return bool If the node was added.
	 */
	protected function add_node( string $address ) {

		$this->nodes[] = $address;
		$added = false;
		// $node = gethostbyaddr( filter_var( $_SERVER['REMOTE_ADDR'], FILTER_VALIDATE_IP ) );
		if ( ! in_array( $address, $this->get_nodes() ) ) {
			file_put_contents( $this->nodes_path, json_encode( $this->nodes ) );
			$added = true;
		}

		return $added;

	}

	/**
	 * Replace the chain if outdated.
	 *
	 * @return bool If the chain was replaced.
	 */
	protected function replace_chain() {

		$nodes = $this->nodes;
		$longest_chain = false;
		$most_transactions = false;
		$max_length = count( $this->chain );
		// $max_verifications = $this->verifications;

		foreach ( $nodes as $node ) {
			$response = $this->get_remote_chain( $node );
			$length = $response->count;
			if ( $length > $max_length && $this->is_chain_valid( $response->chain ) ) {
				$max_length = $length;
				$longest_chain = $response->chain;
			}
		}

		if ( $longest_chain ) {
			file_put_contents( $this->chain_path, json_encode( $longest_chain ) );
			// file_put_contents( $this->domains_path, json_encode( array( $this->genesis_domain ) ) );
			return true;
		} else {
			return false;
		}

	}

	/**
	 * Get remote chain.
	 *
	 * @param string $node The remote node.
	 * @return array $data The remote chain.
	 */
	private function get_remote_chain( $node ) {

		$ch = curl_init( $node . $this->api_path . '?get_chain' );

		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
		curl_setopt( $ch, CURLOPT_HEADER, 0 );
		$data = curl_exec( $ch );
		curl_close( $ch );

		return json_decode( $data );

	}

}
