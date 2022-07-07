<?php
/**
 * Implements the Zero Tracking Policy API.
 *
 * @package Zero_Tracking_Policy
 * @since 1.0.0
 */

/**
 * Class to implement the Zero Tracking Policy API.
 *
 * @since 1.0.0
 */
class Zero_Tracking_Policy_Api extends Zero_Tracking_Policy  {



	/**
	 * Public facing method to get the chain
	 *
	 * @return array $response The json encoded chain.
	 */
	public function get_chain() {

		$chain = parent::get_chain();
		$response = array(
			'chain' => $chain,
			'count' => count( $chain ),
		);

		return json_encode( $response );

	}

	/**
	 * Public facing method to retrieve chain validity status.
	 *
	 * @return bool If the chain is valid.
	 */
	public function is_chain_valid( $chain = false ) {

		$response = array(
			'valid' => parent::is_chain_valid( $chain ),
		);

		return json_encode( $response );

	}

	/**
	 * Public facing method to replace a chain.
	 *
	 * @return array $response the json encoded response of message + chain.
	 */
	public function replace_chain() {

		$replaced = parent::replace_chain();

		if ( $replaced ) {
			$response = array(
				'message' => 'Chain Replaced (Updated)',
				'chain' => parent::get_chain(),
			);
		} else {
			$response = array(
				'message' => 'Chain Not Replaced (Up to date)',
				'chain' => parent::get_chain(),
			);
		}

		return json_encode( $response );

	}

	/**
	 * Public facing method to get last block of a verified domain.
	 *
	 * @param string $domain The (sanitized and validated) Domain to get.
	 * @return array $response The json encoded verification block of the domain.
	 */
	public function get_domain( $domain ) {

		$domain = parent::get_domain( $domain );

		$response = array(
			'verified' => false === $domain[0]->confirmations ? false : true,
			'last_block' => $domain,
			'confirmations' => $domain[0]->confirmations,
		);

		return json_encode( $response );

	}

	/**
	 * Public facing method to stage a domain.
	 *
	 * @param string $domain The (sanitized and validated) Domain to stage.
	 * @return array $response The Response message.
	 */
	public function stage_domain( $domain ) {

		$staged = parent::stage_domain( $domain );
		$response = array(
			'message' => true === $staged ? 'Your Domain is staged and will be verified by the network.' : 'Your domain is not staged. It is either an invalid Domain, or has no public DNS, or is already staged.',
			'domain' => $domain,
		);

		return json_encode( $response );

	}

	/**
	 * Public facing method to verify a domain.
	 *
	 * @param string $domain The (sanitized and validated) Domain to stage.
	 * @return array $response The Response message.
	 */
	public function verify_domain( $domain ) {

		$response = array(
			'message' => 'The domain has been added to the chain and is verified',
			'domain' => parent::verify_domain( $domain ),
		);

		return json_encode( $response );

	}

	/**
	 * Public facing method to add a node.
	 */
	public function add_node( $domain ) {

		$added = parent::add_node( $domain );
		$response = array(
			'message' => true === $added ? 'Your node is added' : 'This node is already on the network',
			'nodes' => parent::get_nodes(),
		);

		return json_encode( $response );

	}

}
