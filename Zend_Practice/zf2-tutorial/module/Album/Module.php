// module/Album/Module.php
namespace Album;

class Module {
	public function getAutoloaderConfig()
	{
		return array(
			'Zend\Loader\ClassMapAutoloader' => array(
				__DIR__ . '/autoload_classmap.php',
			)
			'Zend\Loader\StandardAutoloader' => array(
				'namespaces' => array(
					__NAMESPACES__ => __DIR__ . '/src/' . __NAMESPACE,
				),
			),
		);
	}

	public function getConfig()
	{
		return include __DIR__ . '/config/module.config.php';
	}
}
